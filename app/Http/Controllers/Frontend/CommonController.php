<?php

namespace App\Http\Controllers\Frontend;

use Validator, Session, Storage, Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

use FCommon, LogActivity;
use App\Model\Contact, App\Model\Comment;

class CommonController extends BaseController
{
    protected $time_now;
    protected $lang;
    protected $lang_next;
    public function __construct()
    {
        $this->time_now = Carbon::now();
        $this->lang = isset($_COOKIE['language'])?$_COOKIE['language']:'vi';
        $this->lang_next = ($this->lang == 'en')?'vi':'en';
        $this->time_now = Carbon::now();
    }
    public function Contact(Request $request)
    {

        $data = array(
            'titlePage_Seo'             => trans('common._seo_contact_page_title'),
            'descriptionPage_Seo'       => trans('common._seo_contact_page_description'),
            'imagePage_Seo'             => trans('common._seo_contact_page_image'),
            'header_title'              => trans('common._seo_contact_page_title'),
        );
        return view('frontend/content/page/contact')->with($data);
    }
    public function contactsubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname'  => 'required|string|min:3|max:255',
            'phone'     => 'required|numeric',
            'message'   => 'required|string|min:10|max:200',
        ]);

        if ($validator->fails()) {
            $error_val = $validator->errors();
            $data = array(
                'status' => 0,
                'msg' => 'Có lỗi thử lại sau',
                'list_error' => $error_val->all(),
            );
        }else{
            $fullname   = isset($request->fullname)     ?$request->fullname:'';
            $email      = isset($request->email)        ?$request->email:'';
            $phone      = isset($request->phone)        ?$request->phone:'';
            $message    = isset($request->message)      ?$request->message:'';

            $fullname   = FCommon::ClearStr($fullname);
            $email      = FCommon::ClearStr($email);
            $phone      = FCommon::ClearStr($phone);
            $message    = FCommon::ClearStr($message);

            $date_now = $this->time_now;

            $objToDo = new Contact;
            $objToDo->fullname          = $fullname;
            $objToDo->email             = $email;
            $objToDo->phone             = $phone;
            $objToDo->message           = $message;
            $objToDo->group             = 1;

            if($objToDo->save()){
                $noti_msg = "< ------------------------------- >\nCó liên hệ mới\nHọ và tên: ".$fullname."\nĐiện thoại: ".$phone."\nEmail:".$email."\nNội dung: ".$message."\n< ------------------------------- >\n";
                FCommon::sendMess($noti_msg);

                $data = array(
                    'status'    => 1,
                    'msg'       => trans("common._noti_body_submit_success"),
                );
            }else{
                $data = array(
                    'status'        => 0,
                    'list_error'    => trans("common._noti_body_submit_error"),
                );
            }
        }
        return response()->json($data);
    }
    public function registersubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname'  => 'required|string|min:3|max:255',
            'email'     => 'required|email',
            'phone'     => 'required|numeric',
            'country'   => 'required|not_in:0',
            'year'   => 'required|not_in:0',
        ]);

        if ($validator->fails()) {
            $error_val = $validator->errors();
            $data = array(
                'status' => 0,
                'msg' => 'Có lỗi thử lại sau',
                'list_error' => $error_val->all(),
            );
        }else{
            $fullname   = isset($request->fullname)     ?$request->fullname:'';
            $email      = isset($request->email)        ?$request->email:'';
            $phone      = isset($request->phone)        ?$request->phone:'';
            $message    = isset($request->message)      ?$request->message:'';
            $country    = isset($request->country)      ?$request->country:0;
            $year       = isset($request->year)      ?$request->year:0;

            $fullname   = FCommon::XoaDinhDang($fullname);
            $email      = FCommon::XoaDinhDang($email);
            $phone      = FCommon::XoaDinhDang($phone);
            settype($country, 'int');
            settype($year, 'int');

            $date_now = $this->time_now;

            $data_other = array(
                'country' => $country,
                'year' => $year,
            );

            $data_insert = array(
                'created_date'  => $date_now,
                'modifine_date' => $date_now,
                'fullname'      => $fullname,
                'email'         => $email,
                'phone'         => $phone,
                'message'       => json_encode($data_other),
                'group'         => 2,
            );
            $id = Contact::_add($data_insert);
            if($id > 0){
                $data = array(
                    'status'    => 1,
                    'msg'       => trans("common._noti_body_submit_success"),
                );
            }else{
                $data = array(
                    'status'        => 0,
                    'list_error'    => trans("common._noti_body_submit_error"),
                );
            }
        }
        return response()->json($data);
    }
    public function addcomment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname'      => 'required|string|min:3|max:255',
            'ranking'       => 'required|numeric',
            'phone'         => 'required|numeric',
            'message'       => 'required|min:10|max:1000',
        ]);

        if ($validator->fails()) {
            $error_val = $validator->errors();
            $data = array(
                'status' => 0,
                'msg' => 'Có lỗi thử lại sau',
                'list_error' => $error_val->all(),
            );
        }else{
            $fullname   = isset($request->fullname)     ?$request->fullname:'';
            $email      = isset($request->email)        ?$request->email:'';
            $phone      = isset($request->phone)        ?$request->phone:'';
            $message    = isset($request->message)      ?$request->message:'';
            $ranking    = isset($request->ranking)      ?$request->ranking:0;
            $idPost     = isset($request->idPost)       ?$request->idPost:0;
            $link       = isset($request->link)         ?$request->link:'';

            $fullname   = FCommon::ClearStr($fullname);
            $email      = FCommon::ClearStr($email);
            $phone      = FCommon::ClearStr($phone);
            $message    = FCommon::ClearStr($message);
            $link       = FCommon::ClearStr($link);
            settype($ranking, 'int');
            settype($idPost, 'int');

            $objToDo = new Comment;
            $objToDo->fullname          = $fullname;
            $objToDo->email             = $email;
            $objToDo->phone             = $phone;
            $objToDo->message           = $message;
            $objToDo->ranking           = $ranking;
            $objToDo->post_id           = $idPost;
            $objToDo->link              = $link;
            $objToDo->group             = 1;
            $objToDo->parent            = 0;

            if($objToDo->save()){
                $noti_msg = "< ------------------------------- >\nCó bình luận mới\nHọ và tên: ".$fullname."\nĐiện thoại: ".$phone."\nEmail:".$email."\nĐánh giá: ".$ranking."\nLink: ".$link."\n< ------------------------------- >\n";
                FCommon::sendMess($noti_msg);

                $data = array(
                    'status'    => 1,
                    'msg'       => trans("common._noti_body_submit_success"),
                );
            }else{
                $data = array(
                    'status'        => 0,
                    'list_error'    => trans("common._noti_body_submit_error"),
                );
            }

        }
        return response()->json($data);
    }
    public function aboutus(Request $request)
    {
        $breadcrumb[] = ['title' => trans("common.title_about_us_page")];

        $data = array(
            'titlePage_Seo'             => trans("common.title_about_us_page"),
            'descriptionPage_Seo'       => trans("common.description_about_us_page"),
            'imagePage_Seo'             => trans("common.image_about_us_page"),

            'breadcrumb'                => $breadcrumb,
            'header_title'              => trans("common.title_about_us_page"),
        );

        return view("frontend/content/page/about-us")->with($data);
    }
    
    public function setLocale(Request $request)
    {
        $lang = isset($request->lang)?$request->lang:'vi';
        $url = isset($request->url)?$request->url:'../';
        setcookie('language', $lang, time() + (86400 * 30), "/");
        return redirect($url);
    }
}
