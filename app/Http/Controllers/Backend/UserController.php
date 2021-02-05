<?php

namespace App\Http\Controllers\Backend;

use Validator, Session, Storage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

use Carbon\Carbon;

//Helper
use FCommon, Config;

//Model
use App\Model\User;
use App\Model\Permissions;
use App\Model\Group;

class UserController extends BaseController
{
    protected $time_now, $controller_name;
    public function __construct()
    {
        $this->time_now = Carbon::now();
        $this->controller_name = 'user';
    }

    public function index(Request $request)
    {
        $arr_param      = array();
        $keywork        = isset($request->keywork)?$request->keywork:'';
        $page           = isset($request->page)?$request->page:1;
        settype($page, 'int');
        $keywork = FCommon::ClearStr($keywork);

        $start = $page-1;
        $limit = 40;
        $breadcrumb = '';

        $url = route("admin.$this->controller_name.list").'?'.http_build_query($arr_param);

        if(!empty($keywork)) $arr_param['keywork'] = $keywork;

        $arrResult = User::_list_search(($start * $limit), $limit, $count_row, $arr_param);

        if($count_row > $limit){
            $breadcrumb = FCommon::breadcrumb_search($url, $count_row, $page, $limit, 2);
        }

        if($count_row > 0){
            $record_start = (($page-1)*$limit)+1;
            $record_end = ($page*$limit);
            if($record_end > $count_row) $record_end = $count_row;
            $str_show_record = 'Hiển thị dòng '.$record_start.' đến '.$record_end.' của '.$count_row.' dòng';
        }

        $list_group =  Group::_list();
        $data = array(
            'page_title'        => 'List User',
            'titlePage'         => 'Quản lý User',

            'nav_main'          => 'user',
            'nav_sub'           => 'user-list',

            'list_users'        => $arrResult,
            'list_group'        => $list_group,
            'breadcrumb'        => $breadcrumb,
            'arr_param'         => $arr_param,
            'str_show_record'   => isset($str_show_record)?$str_show_record:'',
        );
        return view('backend/users/list')->with($data);
    }

    public function add(Request $request)
    {
        $data = array(
            'nav_main'          => 'user',
            'nav_sub'           => 'user-list',

            'page_title'        => 'Add User',
            'titlePage'         => 'Thêm mới User',
            'pageType'          => 1,
        );
        return view('backend/users/add')->with($data);
    }

    public function addsubmit(Request $request)
    {
        $pageType     = isset($request->pageType)?$request->pageType:'';
        settype($pageType, 'int');
        $rules = array(
            'fullname' => 'required|string|min:3|max:255',
            'phone' => 'required|numeric|min:9',
            'idgroup' => 'integer|numeric',
            'address' => 'string',
        );
        if($pageType == 1){
            $rules_add = array(
                'email' => [
                    'required',
                    'string',
                    'email',
                    'min:9',
                    'max:255',
                    Rule::unique('mk_users', 'Email')->where('Email', $request->email),
                ],
                'password' => 'required|min:6',
                'repassword' => 'required|min:6|same:password',
            );
            $rules = array_merge($rules, $rules_add);
        }
        $validator = Validator::make( $request->all(), $rules);

        if ($validator->fails()) {
            $error_val = $validator->errors();
            foreach($validator->errors()->all() as $error){
                flash($error)->error();
            }
            return back();
        }else{
            $path_thumbnail     = '';
            if ($request->hasFile('thumbnail')) {
                $ext = $request->thumbnail->getClientOriginalExtension();
                if(FCommon::check_file_upload($ext, 'image')){
                    $file_thumbnail = $request->file('thumbnail');
                    $path_thumbnail = FCommon::upload_file_crop($file_thumbnail, '100x100');
                }
            }else{
                $path_thumbnail = isset($request->avatar)?$request->avatar:'';
            }

            if($pageType == 1){
                $user = new User;

                $user->email        = isset($request->email)?$request->email:'';
                $user->password     = isset($request->password)?Hash::make($request->password):'';
            }else{
                $id           = isset($request->id)?$request->id:'';
                settype($id, 'int');
                $user = User::findOrfail($id);
            }

            $user->fullname     = isset($request->fullname)?$request->fullname:'';
            $user->phone        = isset($request->phone)?$request->phone:'';
            $user->address      = isset($request->address)?$request->address:'';
            $user->avatar       = $path_thumbnail;
            $user->idgroup      = isset($request->idgroup)?$request->idgroup:'';
            $user->active       = isset($request->active)?$request->active:'';

            $user->birthday     = isset($request->birthday)?FCommon::conver_date($request->birthday):'';
            $user->gender       = isset($request->gender)?$request->gender:'';
            if($user->save()){
                $msg = 'Thông tin đã lưu thành công';
                flash($msg)->success();
            }else{
                $msg = 'Có lỗi vui lòng thử lại sau';
                flash($msg)->error();
            }
        }

        return back();
    }

    public function edit(Request $request, $id)
    {
        settype($id, 'int');
        $user = User::findOrfail($id);
        if(!$user){
            return redirect()->route('admin.user.list');;
        }
        $data = array(
            'page_title'        => 'Edit User',
            'titlePage'         => 'Sửa User',

            'nav_main'          => 'user',
            'nav_sub'           => 'user-list',
            'info_user'         => $user,
            'pageType'          => 2,
        );
        return view('backend/users/add')->with($data);
    }

    public function info(Request $request)
    {
        $id = $request->session()->get('user_id');
        settype($id, 'int');
        $user = User::find($id);
        if(!$user){
            return redirect()->route('admin.user.list');
        }
        $data = array(
            'page_title'      => 'Info User',

            'list_permission' => FCommon::arry_group_permission(),
            'info_user'       => $user,
        );
        return view('backend/users/info')->with($data);
    }
    public function infosubmit(Request $request)
    {
        $pageType     = isset($request->pageType)?$request->pageType:'';
        settype($pageType, 'int');
        $rules = array(
            'fullname' => 'required|string|min:3|max:255',
            'phone' => 'required|numeric|min:9',
            'address' => 'string',
        );
        $validator = Validator::make( $request->all(), $rules);

        if ($validator->fails()) {
            $error_val = $validator->errors();
            foreach($validator->errors()->all() as $error){
                flash($error)->error();
            }
            return back();
        }else{
            $id = $request->session()->get('user_id');
            settype($id, 'int');
            if($id < 0) return redirect()->route('admin.user.list');

            $user = User::findOrfail($id);

            $path_thumbnail     = '';
            if ($request->hasFile('thumbnail')) {
                $ext = $request->thumbnail->getClientOriginalExtension();
                if(FCommon::check_file_upload($ext, 'image')){
                    $file_thumbnail = $request->file('thumbnail');
                    $path_thumbnail = FCommon::upload_file_crop($file_thumbnail, '100x100');
                }
            }else{
                $path_thumbnail = isset($request->avatar)?$request->avatar:'';
            }

            $user->fullname     = isset($request->fullname)?$request->fullname:'';
            $user->phone        = isset($request->phone)?$request->phone:'';
            $user->address      = isset($request->address)?$request->address:'';
            $user->avatar       = $path_thumbnail;
            $user->birthday     = isset($request->birthday)?FCommon::conver_date($request->birthday):'';
            $user->gender       = isset($request->gender)?$request->gender:'';

            if($user->save()){
                $msg = 'Thông tin đã lưu thành công';
                flash($msg)->success();
            }else{
                $msg = 'Có lỗi vui lòng thử lại sau';
                flash($msg)->error();
            }
        }
        return back();
    }
    public function updatefullname(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|min:3|max:255',
            'id' => [
                'required',
                'integer',
                Rule::exists('mk_users', 'id')->where('id', $request->id),
            ],
        ]);

        if ($validator->fails()) {
            $error_val = $validator->errors();
            $data = array(
                'status' => 0,
                'msg' => 'Có lỗi thử lại sau',
                'list_error' => $error_val->all(),
            );
        }else{
            $fullname   = isset($request->fullname)?$request->fullname:'';
            $id         = isset($request->id)?$request->id:0;
            settype($id, 'int');
            if($id > 0){
                $id_user = User::Update_Value('fullname', $fullname, $id);

                $data = array(
                    'status' => 1,
                    'msg' => 'Hết lỗi rồi',
                );
            }else{
                $data = array(
                    'status' => 0,
                    'msg' => 'Không cập nhật được',
                );
            }

        }
        return response()->json($data);
    }
    public function updatepermission(Request $request)
    {
        $value  = isset($request->value)?$request->value:'';
        $id     = isset($request->id)?$request->id:0;
        settype($id, 'int');
        if($id > 0){
            $id_user = User::Update_Value('idgroup', $value, $id);

            $data = array(
                'status' => 1,
                'msg' => 'Hết lỗi rồi',
            );
        }else{
            $data = array(
                'status' => 0,
                'msg' => 'Không cập nhật được',
            );
        }


        return response()->json($data);
    }
    public function updatepassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'repassword' => 'required|min:6|same:password',
        ]);

        if ($validator->fails()) {
            $error_val = $validator->errors();

            $data = array(
                'status' => 0,
                'msg' => implode('<br>', $error_val->all()),
            );
        }else{
            $password   = isset($request->password)?$request->password:'';
            $repassword = isset($request->repassword)?$request->repassword:'';
            $id         = isset($request->id)?$request->id:0;
            settype($id, 'int');
            if($id > 0){
                if($password === $repassword){
                    $id_user = User::Update_Value('password', Hash::make($password), $id);
                    $data = array(
                        'status' => 1,
                        'msg' => 'Hết lỗi rồi',
                    );
                }else{
                    $data = array(
                        'status' => 0,
                        'msg' => 'Nhập mật khẩu 2 lần không giống nhau',
                    );
                }
            }else{
                $data = array(
                    'status' => 0,
                    'msg' => 'Không cập nhật được',
                );
            }
        }
        return response()->json($data);

    }
    public function delete(Request $request, $id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
        }
        return redirect()->route('admin.user.list');
    }
    public function group(Request $request)
    {
        $lst_users_group = Group::_list();
        $data = array(
            'page_title'        => 'List Group',
            'titlePage'         => 'Quản lý Group',
            'nav_main'          => 'user',
            'nav_sub'           => 'user-group',

            'list_permission' => $lst_users_group,
        );
        return view('backend/users/group')->with($data);
    }
    public function groupadd(Request $request)
    {
        $list_permissions_main = Permissions::_list_main();
        $list_permissions = Permissions::_list();

        $data = array(
            'page_title'        => 'Add Group',
            'titlePage'         => 'Thêm Group',
            'nav_main'          => 'user',
            'nav_sub'           => 'user-group',
            'pageType'          => 1,

            'list_permissions'          => $list_permissions,
            'list_permissions_main'     => $list_permissions_main,
            'arrPermissions'            => array()
        );
        return view('backend/users/groupadd')->with($data);
    }
    public function groupaddsubmit(Request $request)
    {
        $pageType     = isset($request->pageType)?$request->pageType:'';
        settype($pageType, 'int');
        $rules = array(
            'name' => 'required|string|min:3|max:255',
        );
        $validator = Validator::make( $request->all(), $rules);

        if ($validator->fails()) {
            $error_val = $validator->errors();
            foreach($validator->errors()->all() as $error){
                flash($error)->error();
            }
            return back();
        }else{

            if($pageType == 1){
                $group = new Group;
            }else{
                $id           = isset($request->id)?$request->id:'';
                settype($id, 'int');
                $group = Group::findOrfail($id);
            }
            $permissions        = isset($request->permissions)?$request->permissions:'';
            $arr_permissions    = explode(',', $permissions);

            $group->name             = isset($request->name)?$request->name:'';
            $group->permissions      = json_encode($arr_permissions);

            if($group->save()){
                $msg = 'Thông tin đã lưu thành công';
                flash($msg)->success();
            }else{
                $msg = 'Có lỗi vui lòng thử lại sau';
                flash($msg)->error();
            }
        }

        return back();
    }
    public function groupPermissions(Request $request, $id)
    {
        $arrResult = Group::findOrfail($id);
        $list_permissions_main = Permissions::_list_main();
        $list_permissions = Permissions::_list();
        $data = array(
            'page_title'                => 'Edit Group',
            'titlePage'                 => 'Sửa Group',

            'nav_main'                  => 'user',
            'nav_sub'                   => 'user-group',
            'pageType'                  => 2,

            'list_permissions'          => $list_permissions,
            'list_permissions_main'     => $list_permissions_main,

            'arrResult'                   => $arrResult,
            'arrPermissions'            => !empty($arrResult->permissions)?json_decode($arrResult->permissions):array()
        );
        return view('backend/users/groupadd')->with($data);
    }
    public function groupsubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            $error_val = $validator->errors();
            $data = array(
                'status' => 0,
                'msg' => 'Có lỗi thử lại sau',
                'list_error' => $error_val->all(),
            );
        }else{
            $name = isset($request->name)?$request->name:'';


            $data_insert = array(
                'name'          => $name,
            );

            $id_user = group::_add($data_insert);

            $data = array(
                'status' => 1,
                'msg' => 'Hết lỗi rồi',
            );
        }
        return response()->json($data);
    }

    public function permissions(Request $request)
    {
        $list_permissions_main = Permissions::_list_main();
        $list_permissions = Permissions::_list();
        $data = array(
            'page_title'                => 'List Permissions',
            'titlePage'                 => 'Quản lý',
            'nav_main'                  => 'user',
            'nav_sub'                   => 'user-permissions',

            'list_permissions'          => $list_permissions,
            'list_permissions_main'     => $list_permissions_main
        );
        return view('backend/users/permissions')->with($data);
    }
    public function permissionssubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'controller' => 'required|string',
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            $error_val = $validator->errors();
            $data = array(
                'status' => 0,
                'msg' => 'Có lỗi thử lại sau',
                'list_error' => $error_val->all(),
            );
        }else{
            $parent         = isset($request->parent)?$request->parent:0;
            $name           = isset($request->name)?$request->name:'';
            $description    = isset($request->description)?$request->description:'';
            $controller     = isset($request->controller)?$request->controller:'';
            $action         = isset($request->action)?$request->action:'';
            $routername     = isset($request->routername)?$request->routername:'';


            $date_now = $this->time_now;

            $data_insert = array(
                'parent'        => $parent,
                'name'          => $name,
                'description'   => $description,
                'controller'    => $controller,
                'action'        => $action,
                'routername'    => $routername,
            );

            $id_user = Permissions::_add($data_insert);

            $data = array(
                'status' => 1,
                'msg' => 'Hết lỗi rồi',
            );
        }
        return response()->json($data);
    }
    public function permissionsDelete(Request $request, $id)
    {
        $result = permissions::_delete($id);
        return redirect()->route('admin.permissions.index');
    }

    public function groupPermissionsSubmit(Request $request, $id)
    {
        $data = isset($request->data)?$request->data:'';
        $arr_permissions = explode(',', $data);

        $data_update = array(
            'permissions'        => json_encode($arr_permissions),
        );

        Group::_edit($id, $data_update);

        $data = array(
            'status'    => 1,
            'msg'       => 'Hết lỗi rồi',
            'data'      => $arr_permissions
        );
        return response()->json($data);
    }
}
