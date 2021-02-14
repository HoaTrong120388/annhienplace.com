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
use FCommon, LogActivity, Config;

//Model
use App\Model\Contact, App\Model\User;

class ContactController extends BaseController
{
    protected $time_now, $controller_name, $group;
    public function __construct()
    {
        $this->time_now = Carbon::now();
        $this->controller_name = 'contact';
        $this->group = 1;
    }

    public function index(Request $request)
    {
        $keyword         = isset($request->keyword)?$request->keyword:'';
        $keyword = FCommon::ClearStr($keyword);
        $arrFilter = array();

        $sql = Contact::where('group', $this->group);
        if(!empty($keyword)){
            $sql = $sql->where('fullname', 'like', '%'.$keyword.'%')->orwhere('phone', 'like', '%'.$keyword.'%')->orwhere('message', 'like', '%'.$keyword.'%');
            $arrFilter['keyword'] = $keyword;
        }
        $arrResult = $sql->orderBy('created_at', 'desc')->paginate(20);
        $arrResult->appends($arrFilter);

        // dd($arrResult);
        if($arrResult->total() > 0){
            $record_start = (($arrResult->currentPage()-1)*$arrResult->perPage())+1;
            $record_end = ($arrResult->currentPage()*$arrResult->perPage());
            if($record_end > $arrResult->total()) $record_end = $arrResult->total();
            $str_show_record = 'Hiển thị dòng '.$record_start.' đến '.$record_end.' của '.$arrResult->total().' dòng';
        }
        $data = array(
            'page_title'        => 'Contact',
            'titlePage'         => 'Quản lý liên hệ',

            'nav_main'          => 'contact',
            'nav_sub'           => 'contact-index',
            'strControler'      => $this->controller_name,

            'arrResult'         => $arrResult,
            'arrFilter'         => $arrFilter,
            'str_show_record'   => isset($str_show_record)?$str_show_record:''
        );
        return view("backend/$this->controller_name/list", $data);
    }

    public function delete(Request $request)
    {
        $id = isset($request->id)?$request->id:0;
        settype($id, 'int');
        if($id > 0){
            $page = Contact::findOrfail($id);
            if($page){
                $page->delete();
            }
            return back();
        }

    }
}
