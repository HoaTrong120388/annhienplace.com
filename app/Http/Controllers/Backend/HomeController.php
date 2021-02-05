<?php

namespace App\Http\Controllers\Backend;

use Validator, Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use FCommon, Config;

//Model
use App\Model\User,
    App\Model\Post,
    App\Model\Page,
    App\Model\Catalog,
    App\Model\Group,
    App\Model\Permissions,
    App\Model\Contact;

class HomeController extends BaseController
{

    protected $time_now;
    public function __construct()
    {
        $this->time_now = Carbon::now('Asia/Bangkok');
    }

    public function dashboard(Request $request)
    {
        $member_id = $request->session()->get('user_id');
        $total_dichvu = Post::where('group', 1)->count();
        $total_tintuc = Post::where('group', 2)->count();
        $total_contact = Contact::where('group', 1)->count();
        $total_langdingpage = Contact::where('group', 2)->count();
        $list_contact_new = Contact::where('group', 1)->orderBy('id', 'desc')->limit(5)->get();
        $list_post_dichvu = Post::where('group', 1)->orderBy('id', 'desc')->limit(5)->get();
        $list_post_news = Post::where('group', 2)->orderBy('id', 'desc')->limit(5)->get();

        // $arrResultStaticcardvalue = $_static_dashboard['arrResultStaticcardvalue'];
        // if(isset($arrResultStaticcardvalue) && count($arrResultStaticcardvalue) > 0){
        //     $arrLabel = array();
        //     $arrData = array();
        //     foreach($arrResultStaticcardvalue as $itemNetwork){
        //         $arrLabel[] = '"'.$itemNetwork->cardvalue.'"';
        //         $arrData[] =    $itemNetwork->total;
        //     }
        //     $dataPie2 = array(
        //         'label' => implode(',', $arrLabel),
        //         'data' => implode(',', $arrData),
        //     );
        // }

        $data = array(

            'nav_main'      => 'dashboard',
            'nav_sub'       => '',
            'page_title'    => 'Dashboard ',

            'total_dichvu'              => $total_dichvu,
            'total_tintuc'              => $total_tintuc,
            'total_contact'             => $total_contact,
            'total_langdingpage'        => $total_langdingpage,
            'list_contact_new'          => $list_contact_new,
            'list_post_dichvu'          => $list_post_dichvu,
            'list_post_news'            => $list_post_news,
        );
        // return redirect()->route('admin.napthe.index');
        return view('backend/index/dashboard')->with($data);
    }

    public function login(Request $request)
    {
        $error_login = '';

        if ($request->session()->exists('error_login')) {
            $error_login = $request->session()->get('error_login');
            $request->session()->forget('error_login');
            $request->session()->forget(['user_id', 'user_fullname', 'user_permission', 'user_avatar']);
        }
        if($request->session()->exists('user_id')){
            redirect()->route('admin.dashboard');
        }
        return view('backend/login/login')->with(['error_login' => $error_login]);
    }
    public function loginsubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|min:6|max:255',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            foreach($validator->errors()->all() as $error){
                flash($error)->error();
            }
            return  redirect()
                    ->route('admin.login')
                    ->withErrors($validator)
                    ->withInput();
        }else{
            $email = $request->email;
            $password = $request->password;

            $result = User::CheckEmailExit($email);
            if($result){
                $user = User::where('email', $email)->latest()->first();
                if($user){
                    if (Hash::check($password, $user->password)) {
                        $error = 'Thành công';
                        $request->session()->put('user_id', $user->id);
                        $request->session()->put('user_fullname', $user->fullname);
                        $request->session()->put('user_group', $user->idgroup);
                        $request->session()->put('user_group_name', isset($user->group->name)?$user->group->name:'Ngoài tầm kiểm soát');
                        $request->session()->put('user_avatar', $user->avatar);
                        $request->session()->put('user_email', $user->email);
                        $request->session()->put('user_money', $user->tiensau);
                        // FCommon::debug($user->idgroup, true);
                        if($user->idgroup != 10001){
                            $Permissions = Group::find($user->idgroup);
                            if(empty($Permissions->permissions)){
                                $error = 'Bạn không có bất cứ quyền nào';
                                flash($error)->error();
                                return  redirect()->route('admin.login')->with('error_login', $error);
                            }
                            $lst_id_Permissions = json_decode($Permissions->permissions);
                            if(empty($lst_id_Permissions)){
                                $error = 'Bạn không có quyền vào trang này';
                                flash($error)->error();
                                return  redirect()->route('admin.login')->with('error_login', $error);
                            }
                            $lst_Permissions_action = array();
                            foreach($lst_id_Permissions as $id){
                                $inf_permissions = Permissions::find($id);
                                if($inf_permissions['routername'] !== '' && !in_array($inf_permissions['routername'], $lst_Permissions_action))
                                    $lst_Permissions_action[]       = $inf_permissions['routername'];
                            }
                            $request->session()->put('lst_Permissions_action', array_filter($lst_Permissions_action));
                        }


                        $data_update_login = array(
                            'last_login' => $this->time_now,
                        );


                        User::Edit_User($user->id, $data_update_login);
                        flash('Chào mừng bạn đã quay trở lại')->success();
                        if($request->session()->exists('url_back')){
                            $back_link = $request->session()->get('url_back');
                            $request->session()->forget('url_back');
                            return redirect($back_link);
                        }else{
                            return redirect()->route('admin.dashboard');
                        }
                    }else{
                        $error = 'Mật khẩu không đúng';
                        flash($error)->error();
                        return  redirect()->route('admin.login')->with('error_login', $error);
                    }
                }else{
                    $error = 'Email của bạn không đúng hoặc chưa kích hoạt';
                    flash($error)->error();
                    return  redirect()->route('admin.login')->with('error_login', $error);
                }

            }else{
                $error = 'Không tồn tại email này trong hệ thống';
                flash($error)->error();
                return  redirect()->route('admin.login')->with('error_login', $error);
            }
        }
    }
    public function resetpass(Request $request)
    {
        return view('backend/login/reset-password');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        return redirect()->route('admin.login');
    }
    public function lockscreen(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                return  redirect()
                        ->route('admin.lockscreen')
                        ->withErrors($validator)
                        ->withInput();
            }else{
                $email = $request->session()->get('lock_screen_email_user');
                $password = $request->password;
                $user = User::GetInfoUser($email);
                if($user){
                    if (Hash::check($password, $user->password)) {
                        $error = 'Thành công';
                        $request->session()->put('user_id', $user->id);
                        $request->session()->put('user_fullname', $user->fullname);
                        $request->session()->put('user_permission', $user->idgroup);
                        $request->session()->put('user_avatar', $user->avatar);
                        $request->session()->put('user_email', $user->email);

                        $data_update_login = array(
                            'last_login' => $this->time_now,
                        );


                        User::Edit_User($user->id, $data_update_login);

                        if($request->session()->exists('url_back')){
                            $back_link = $request->session()->get('url_back');
                            $request->session()->forget('url_back');
                            return redirect($back_link);
                        }else{
                            return redirect()->route('admin.dashboard');
                        }
                    }else{
                        $error = 'Mật khẩu không đúng';
                        return  redirect()->route('admin.login')->with('error_login', $error);
                    }
                }else{
                    $error = 'Email của bạn không đúng hoặc chưa kích hoạt';
                    return  redirect()->route('admin.login')->with('error_login', $error);
                }
            }
        }else{
            $request->session()->put('lock_screen_email_user', $request->session()->get('user_email'));
            $request->session()->forget('user_id');
        }
        return view('backend/login/lock-screen');
    }
    public function updatestatus(Request $request)
    {
        $data  = isset($request->data)?$request->data:'';
        $status = isset($request->status)?$request->status:0;


        $data = FCommon::ClearStr($data);
        $arr_data = explode(";", $data);
        $id = $arr_data[0];
        $table = $arr_data[1];

        settype($id, 'int');
        settype($status, 'int');
        if($id > 0 && $table != ''){
            $result = DB::table($table)->where('id', $id)->update(['status' => $status]);
            if($result){
                $response = array(
                    'status' => 1,
                    'msg' => 'Hết lỗi rồi',
                );
            }else{
                $response = array(
                    'status' => 2,
                    'msg' => 'Có lỗi thử lại sau',
                );
            }
        }else{
            $response = array(
                'status' => 3,
                'msg' => 'Có lỗi thử lại sau',
            );
        }
        return response()->json($response);
    }
    public function updatedata(Request $request)
    {
        $data  = isset($request->data)?$request->data:'';
        $status = isset($request->status)?$request->status:-1;
        $special = isset($request->special)?$request->special:-1;


        $data = FCommon::ClearStr($data);
        $arr_data = explode(";", $data);
        $id = $arr_data[0];
        $table = $arr_data[1];

        settype($id, 'int');
        settype($status, 'int');
        settype($special, 'int');
        if($id > 0 && $table != ''){
            if($status != -1)
                $result = DB::table($table)->where('id', $id)->update(['status' => $status]);
            elseif($special != -1)
                $result = DB::table($table)->where('id', $id)->update(['special' => $special]);

            if($result){
                $response = array(
                    'status' => 1,
                    'msg' => 'Hết lỗi rồi',
                );
            }else{
                $response = array(
                    'status' => 2,
                    'msg' => 'Có lỗi thử lại sau',
                    'special' => $special
                );
            }
        }else{
            $response = array(
                'status' => 3,
                'msg' => 'Có lỗi thử lại sau',
            );
        }
        return response()->json($response);
    }
    public function updateorder(Request $request)
    {
        $order  = isset($request->order)?$request->order:0;
        $id     = isset($request->id)?$request->id:0;
        $table  = isset($request->table)?$request->table:'';

        settype($id, 'int');
        settype($order, 'int');
        if($id > 0 && $table != ''){
            $result = DB::table($table)->where('id', $id)->update(['order' => $order]);

            if($result){
                $data = array(
                    'status' => 1,
                    'msg' => 'Hết lỗi rồi',
                );
            }else{
                $data = array(
                    'status' => 0,
                    'msg' => 'Có lỗi thử lại sau',
                );
            }
        }else{
            $data = array(
                'status' => 0,
                'msg' => 'Có lỗi thử lại sau',
            );
        }
        return response()->json($data);
    }
}
