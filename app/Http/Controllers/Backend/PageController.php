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
use FCommon, LogActivity;

//Model
use App\Model\Page, App\Model\User;

class PageController extends BaseController
{
    protected $time_now, $controller_name;
    public function __construct()
    {
        $this->time_now = Carbon::now();
        $this->controller_name = 'page';
    }

    public function index(Request $request)
    {
        $keyword         = isset($request->keyword)?$request->keyword:'';
        $keyword = FCommon::ClearStr($keyword);
        $arrFilter = array();

        $sql = Page::where('id', '>', 0);
        if(!empty($keyword)){
            $sql = $sql->where('title', 'like', '%'.$keyword.'%');
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
            'page_title'        => 'Page',
            'titlePage'         => 'Quản lý trang tĩnh',

            'nav_main'          => 'page',
            'nav_sub'           => 'page',
            'strControler'      => $this->controller_name,

            'arrResult'         => $arrResult,
            'arrFilter'         => $arrFilter,
            'str_show_record'   => isset($str_show_record)?$str_show_record:''
        );
        return view("backend/$this->controller_name/list", $data);
    }
    public function todo(Request $request)
    {
        $data = array(
            'page_title'        => 'Page',
            'titlePage'         => 'Thêm/Sửa Trang Tĩnh',

            'nav_main'          => 'page',
            'nav_sub'           => 'page',
            'strControler'      => $this->controller_name,
        );

        $id = isset($request->id)?$request->id:0;
        settype($id, 'int');
        if($id > 0){
            $arrResult = Page::findOrfail($id);
            if($arrResult){
                $arrResult->seo = json_decode($arrResult->seo);
                $arrResult->more_info = json_decode($arrResult->more_info);
                $arrResult->public_date = Carbon::parse($arrResult->public_date)->format('d-m-Y');
                $data['arrResult'] = $arrResult;
            }
            // dd($arrResult);
        }


        return view("backend/$this->controller_name/todo", $data);
    }
    public function todosubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'                     => 'required',
            'file_thumbnail'            => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            'file_seo_image'            => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            'file_header_banner_pc'     => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            'file_header_banner_mobile'      => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        if ($validator->fails()) {
            $error = implode('<br>', $validator->errors()->all());
            flash($error)->error();
            return  back()->withErrors($validator)->withInput();
        }else{

            $title                  = isset($request->title)                    ?$request->title:'';
            $summary                = isset($request->summary)                  ?$request->summary:'';
            $content                = isset($request->content)                  ?$request->content:'';
            $thumbnail              = isset($request->thumbnail)                ?$request->thumbnail:'';
            $seo_image              = isset($request->seo_image)                ?$request->seo_image:'';
            $seo_title              = isset($request->seo_title)                ?$request->seo_title:'';
            $seo_description        = isset($request->seo_description)          ?$request->seo_description:'';
            $seo_keyword            = isset($request->seo_keyword)              ?$request->seo_keyword:'';
            $header_banner_pc       = isset($request->header_banner_pc)         ?$request->header_banner_pc:'';
            $header_banner_mobile   = isset($request->header_banner_mobile)     ?$request->header_banner_mobile:'';
            $public_date            = isset($request->public_date)              ?$request->public_date:'';
            $status                 = isset($request->status)                   ?$request->status:0;
            $parent                 = isset($request->parent)                   ?$request->parent:1;
            $template               = isset($request->template)                 ?$request->template:1;

            settype($parent, 'int');
            settype($template, 'int');

            $title                  = FCommon::ClearStr($title);
            $thumbnail              = FCommon::ClearStr($thumbnail);
            $seo_image              = FCommon::ClearStr($seo_image);
            $seo_title              = FCommon::ClearStr($seo_title);
            $seo_description        = FCommon::ClearStr($seo_description);
            $seo_keyword            = FCommon::ClearStr($seo_keyword);
            $header_banner_pc       = FCommon::ClearStr($header_banner_pc);
            $header_banner_mobile   = FCommon::ClearStr($header_banner_mobile);
            $public_date            = FCommon::ClearStr($public_date);
            $status                 = FCommon::ClearStr($status);
            if($status == 'on') $status = 1;

            if ($request->hasFile('file_thumbnail')) {
                $ext = $request->file_thumbnail->getClientOriginalExtension();
                if(FCommon::check_file_upload($ext, 'image')){
                    $file_file_thumbnail = $request->file('file_thumbnail');
                    $thumbnail = FCommon::upload_file_crop($file_file_thumbnail, '200x200');
                    // dd($thumbnail);
                }
            }
            // dd($thumbnail);
            if ($request->hasFile('file_seo_image')) {
                $ext = $request->file_seo_image->getClientOriginalExtension();
                if(FCommon::check_file_upload($ext, 'image')){
                    $file_file_seo_image = $request->file('file_seo_image');
                    $seo_image = FCommon::upload_file_crop_size($file_file_seo_image);
                }
            }
            if ($request->hasFile('file_header_banner_pc')) {
                $ext = $request->file_header_banner_pc->getClientOriginalExtension();
                if(FCommon::check_file_upload($ext, 'image')){
                    $file_file_header_banner_pc = $request->file('file_header_banner_pc');
                    $header_banner_pc = FCommon::upload_file_crop_size($file_file_header_banner_pc);
                }
            }
            if ($request->hasFile('file_header_banner_mobile')) {
                $ext = $request->file_header_banner_mobile->getClientOriginalExtension();
                if(FCommon::check_file_upload($ext, 'image')){
                    $file_file_header_banner_mobile = $request->file('file_header_banner_mobile');
                    $header_banner_mobile = FCommon::upload_file_crop_size($file_file_header_banner_mobile);
                }
            }
            if ($request->hasFile('file_banner_form_register')) {
                $ext = $request->file_banner_form_register->getClientOriginalExtension();
                if(FCommon::check_file_upload($ext, 'image')){
                    $file_file_banner_form_register = $request->file('file_banner_form_register');
                    $banner_form_register = FCommon::upload_file_crop_size($file_file_banner_form_register);
                }
            }

            $arrSeo = array(
                'title'         => !empty($seo_title)?$seo_title:$title,
                'description'   => $seo_description,
                'keyword'       => $seo_keyword,
                'image'         => $seo_image,
            );
            $arrInfo = array(
                'header_banner_pc'  => $header_banner_pc,
                'header_banner_mobile'  => $header_banner_mobile,
                'banner_form_register'  => $banner_form_register,
                'template'  => $template
            );

            $id                  = isset($request->id)                    ?$request->id:0;
            settype($id, 'int');
            if($id > 0){
                $page = Page::findOrfail($id);
            }else{
                $page = new Page;
            }

            $page->title = $title;
            $page->slug = Str::slug($title);
            $page->summary = $summary;
            $page->content = $content;
            $page->thumbnail = $thumbnail;
            $page->seo = json_encode($arrSeo);
            $page->more_info = json_encode($arrInfo);
            $page->public_date = FCommon::conver_date($public_date);
            $page->status = $status;
            $page->parent = $parent;
            $page->user_id = $request->session()->get('user_id');

            if($page->save()){
                LogActivity::addToLog('Thêm page mới - '.$page->id, $page);
                flash('Thêm thành công')->success();
                return back();
            }else{
                flash('Có lỗi vui lòng thử lại sau')->error();
                return back();
            }
        }

    }
    public function delete(Request $request)
    {
        $id = isset($request->id)?$request->id:0;
        settype($id, 'int');
        if($id > 0){
            $page = Page::findOrfail($id);
            if($page){
                $page->delete();
            }
            return back();
        }

    }
}
