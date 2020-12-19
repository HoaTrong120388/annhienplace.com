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
use App\Model\Contact;

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
        $arrResult = array(
            'title' => trans("common.nav_contact"),
        );
        $redirect_lang = ($this->lang == 'en')?'lien-he':'contact';

        $breadcrumb = array(
            array(
                'title' => 'Home',
                'link'  => route('frontend.home')
            ),
            array(
                'title' => trans('common.nav_contact'),
            )
        );

        $data = array(
            'titlePage_Seo'             => trans('common._seo_contact_page_title'),
            'descriptionPage_Seo'       => trans('common._seo_contact_page_description'),
            'imagePage_Seo'             => trans('common._seo_contact_page_title'),

            'arrResult'                 => $arrResult,
            'redirect_lang'             => $redirect_lang,
            'breadcrumb'                => $breadcrumb,
        );
        return view('frontend/common/contact')->with($data);
    }
    public function contactsubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname'  => 'required|string|min:3|max:255',
            'email'     => 'required|email',
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

            $data_insert = array(
                'created_date'  => $date_now,
                'modifine_date' => $date_now,
                'fullname'      => $fullname,
                'email'         => $email,
                'phone'         => $phone,
                'message'       => $message,
                'group'         => 1,
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
            $error = implode('<br>', $validator->errors()->all());

            $data = array(
                'status' => 0,
                'msg' => 'Có lỗi thử lại sau 11',
                'list_error' => $error,
            );
        }else{
            $fullname   = isset($request->fullname)     ?$request->fullname:'';
            $email      = isset($request->email)        ?$request->email:'';
            $phone      = isset($request->phone)        ?$request->phone:'';
            $message    = isset($request->message)      ?$request->message:'';
            $country    = isset($request->country)      ?$request->country:0;
            $year       = isset($request->year)      ?$request->year:0;

            $fullname   = FCommon::ClearStr($fullname);
            $email      = FCommon::ClearStr($email);
            $phone      = FCommon::ClearStr($phone);
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
    public function landingpageregistersubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname'  => 'required|string|min:3|max:255',
            'email'     => 'required|email',
            'phone'     => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $error = implode('<br>', $validator->errors()->all());
            $data = array(
                'status' => 0,
                'msg' => 'Có lỗi thử lại sau',
                'list_error' => $error,
            );
        }else{
            $fullname   = isset($request->fullname)     ?$request->fullname:'';
            $email      = isset($request->email)        ?$request->email:'';
            $phone      = isset($request->phone)        ?$request->phone:'';
            $message    = isset($request->content)      ?$request->content:'';

            $fullname   = FCommon::ClearStr($fullname);
            $email      = FCommon::ClearStr($email);
            $phone      = FCommon::ClearStr($phone);
            $message    = FCommon::ClearStr($message);

            $date_now = $this->time_now;

            $contact = new Contact;

            $contact->fullname = $fullname;
            $contact->email = $email;
            $contact->phone = $phone;
            $contact->message = $message;
            $contact->group = 3;

            if($contact->save()){
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
    public function setLocale(Request $request)
    {
        $lang = isset($request->lang)?$request->lang:'vi';
        $url = isset($request->url)?$request->url:'../';
        setcookie('language', $lang, time() + (86400 * 30), "/");
        return redirect($url);
    }
}
