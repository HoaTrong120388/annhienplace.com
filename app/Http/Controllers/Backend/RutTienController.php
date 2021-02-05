<?php

namespace App\Http\Controllers\Backend;

use Validator, Session, Storage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

use Carbon\Carbon;

//Helper
use FCommon, Config;

//Model
use App\Model\Contact;
use App\Model\Translation;

class RutTienController extends BaseController
{
    protected $time_now;
    public function __construct()
    {
        $this->time_now = Carbon::now();
    }

    public function index(Request $request, $page = 1)
    {
        $arr_param  = array();
        $phone      = isset($request->phone)?$request->phone:'';
        $fullname   = isset($request->fullname)?$request->fullname:'';
        $status     = isset($request->status)?$request->status:-1;
        $type       = isset($request->type)?$request->type:0; //0: bthg; 1: search
        $page       = isset($request->page)?$request->page:1;

        //setup phân trang
        $start = $page-1;
        $limit = 20;
        $breadcrumb = '';

        if($type == 1){

            $arr_param = array(
                'phone'     => $phone,
                'fullname'  => $fullname,
                'status'    => $status,
                'type'      => $type,
                'page'      => $page,
                'limit'     => $limit,
            );
            $url = route('admin.contact.list').'?type='.$type.'&fullname='.$fullname.'&status='.$status.'&phone='.$phone;
        }else{
            $url = route('admin.contact.list');
        }
        $arrResult = Contact::_list_search(($start * $limit), $limit, $count_row, 1, $arr_param);
        // FCommon::debug($arrResult, true);
        if($count_row > $limit){
            if($type == 1)
                $breadcrumb = FCommon::breadcrumb_search($url, $count_row, $page, $limit, 2);
            else
                $breadcrumb = FCommon::breadcrumb($url, $count_row, $page, $limit, 2);
        }

        $data = array(
            'page_title'        => 'List Contact',
            'page_description'  => 'Quản lý liên hệ',
            'titlePage'         => 'Quản lý liên hệ',

            'arrResult'         => $arrResult,
            'totalResult'       => $count_row,
            'breadcrumb'        => $breadcrumb,
            'arr_param'         => $arr_param,

        );
        return view('backend/contact/list')->with($data);
    }

    public function delete(Request $request, $id)
    {
        $result = Contact::_delete($id);
        return redirect()->route('admin.contact.list');
    }
}
