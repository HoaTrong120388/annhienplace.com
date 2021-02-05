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
use App\Model\Catalog, App\Model\User;

class CatalogController extends BaseController
{
    protected $time_now, $controller_name;
    public function __construct()
    {
        $this->time_now = Carbon::now();
        $this->controller_name = 'catalog';
        $this->controller_group = 1;

        // dd(Config::get('website.allowFileImage'));
    }

    public function index(Request $request)
    {
        $lst_catalog = Catalog::where('group', $this->controller_group)->where('parent', 0)->get();

        $data = array(
            'page_title'        => 'Catalog',
            'titlePage'         => 'Quản lý danh mục',

            'nav_main'          => 'post',
            'nav_sub'           => 'catalog-index',
            'strControler'      => $this->controller_name,

            'arrResult'       => $lst_catalog
        );
        return view("backend/$this->controller_name/list", $data);
    }
    public function todo(Request $request)
    {
        $lst_catalog = Catalog::where('group', $this->controller_group)->where('parent', 0)->get();
        $data = array(
            'page_title'        => 'Catalog',
            'titlePage'         => 'Thêm/Sửa Danh Mục',

            'nav_main'          => 'post',
            'nav_sub'           => 'catalog-index',
            'strControler'      => $this->controller_name,
            'lst_catalog'       => $lst_catalog
        );

        $id = isset($request->id)?$request->id:0;
        settype($id, 'int');
        if($id > 0){
            $arrResult = Catalog::findOrfail($id);
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
            'title'                         => 'required',
            'file_thumbnail'                => "nullable|mimes:".Config::get('website.allowFileImage')."|max:10000",
            'file_seo_image'                => "nullable|mimes:".Config::get('website.allowFileImage')."|max:10000",
            'file_header_banner_pc'         => "nullable|mimes:".Config::get('website.allowFileImage')."|max:10000",
            'file_header_banner_mobile'     => "nullable|mimes:".Config::get('website.allowFileImage')."|max:10000",
        ]);

        if ($validator->fails()) {
            $error = implode('<br>', $validator->errors()->all());
            flash($error)->error();
            return  back()->withErrors($validator)->withInput();
        }else{

            $title                  = isset($request->title)                    ?$request->title:'';
            $summary                = isset($request->summary)                  ?$request->summary:'';
            $thumbnail              = isset($request->thumbnail)                ?$request->thumbnail:'';
            $seo_image              = isset($request->seo_image)                ?$request->seo_image:'';
            $seo_title              = isset($request->seo_title)                ?$request->seo_title:'';
            $seo_description        = isset($request->seo_description)          ?$request->seo_description:'';
            $seo_keyword            = isset($request->seo_keyword)              ?$request->seo_keyword:'';
            $header_banner_pc       = isset($request->header_banner_pc)         ?$request->header_banner_pc:'';
            $header_banner_mobile   = isset($request->header_banner_mobile)     ?$request->header_banner_mobile:'';
            $banner_home            = isset($request->banner_home)              ?$request->banner_home:'';
            $icon                   = isset($request->icon)                     ?$request->icon:'';
            $status                 = isset($request->status)                   ?$request->status:0;
            $parent                 = isset($request->parent)                   ?$request->parent:1;
            $template               = isset($request->template)                 ?$request->template:1;
            $order                  = isset($request->order)                    ?$request->order:1;

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
            $banner_home            = FCommon::ClearStr($banner_home);
            $icon                   = FCommon::ClearStr($icon);
            $status                 = FCommon::ClearStr($status);
            $order                  = FCommon::ClearStr($order);
            if($status == 'on') $status = 1;
            settype($order, 'int');

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
                    $header_banner_pc = FCommon::upload_file_crop_size($file_file_header_banner_pc, '200x200');
                }
            }
            if ($request->hasFile('file_header_banner_mobile')) {
                $ext = $request->file_header_banner_mobile->getClientOriginalExtension();
                if(FCommon::check_file_upload($ext, 'image')){
                    $file_file_header_banner_mobile = $request->file('file_header_banner_mobile');
                    $header_banner_mobile = FCommon::upload_file_crop_size($file_file_header_banner_mobile, '200x200');
                }
            }
            if ($request->hasFile('file_banner_home')) {
                $ext = $request->file_banner_home->getClientOriginalExtension();
                if(FCommon::check_file_upload($ext, 'image')){
                    $file_file_banner_home = $request->file('file_banner_home');
                    $banner_home = FCommon::upload_file_crop_size($file_file_banner_home);
                }
            }
            if ($request->hasFile('file_icon')) {
                $ext = $request->file_icon->getClientOriginalExtension();
                if(FCommon::check_file_upload($ext, 'image')){
                    $file_file_icon = $request->file('file_icon');
                    $icon = FCommon::upload_file_crop_size($file_file_icon);
                }
            }

            $arrSeo = array(
                'title'         => !empty($seo_title)?$seo_title:$title,
                'description'   => $seo_description,
                'keyword'       => $seo_keyword,
                'image'         => $seo_image,
            );
            $arrInfo = array(
                'header_banner_pc'      => $header_banner_pc,
                'header_banner_mobile'  => $header_banner_mobile,
                'template'              => $template,
            );

            $id = isset($request->id)?$request->id:0;
            settype($id, 'int');
            if($id > 0){
                $objToDo = Catalog::findOrfail($id);
                if($parent == $id) $parent = 0;
            }else{
                $objToDo = new Catalog;
            }

            $objToDo->title         = $title;
            $objToDo->slug          = Str::slug($title);
            $objToDo->summary       = $summary;
            $objToDo->thumbnail     = $thumbnail;
            $objToDo->seo           = json_encode($arrSeo);
            $objToDo->more_info     = json_encode($arrInfo);
            $objToDo->status        = $status;
            $objToDo->parent        = $parent;
            $objToDo->order         = $order;
            $objToDo->banner_home   = $banner_home;
            $objToDo->icon          = $icon;
            $objToDo->group         = $this->controller_group;

            if($objToDo->save()){
                LogActivity::addToLog('Thêm catalog mới - '.$objToDo->id, $objToDo, 2);
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
            $objData = Catalog::findOrfail($id);
            if($objData){
                $lst_child = Catalog::where('parent', $objData->id)->update(array('parent'=> $objData->parent));
                $objData->delete();
                flash('Đã xóa thành công')->success();
            }
            return back();
        }

    }
}
