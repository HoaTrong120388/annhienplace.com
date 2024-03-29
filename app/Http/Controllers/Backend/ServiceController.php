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
use App\Model\Catalog, App\Model\Post, App\Model\PostOption, App\Model\User;

class ServiceController extends BaseController
{
    protected $time_now, $controller_name, $lst_catalog, $group;
    public function __construct()
    {
        $this->time_now = Carbon::now();
        $this->controller_name = 'service';
        $this->group = 3;
        $this->lst_catalog = Catalog::where('group', 3)->where('parent', 0)->get();
    }

    public function index(Request $request)
    {
        $keyword         = isset($request->keyword)?$request->keyword:'';
        $keyword = FCommon::ClearStr($keyword);
        $arrFilter = array();

        $sql = Post::where('group', $this->group);
        if(!empty($keyword)){
            $sql = $sql->where('title', 'like', '%'.$keyword.'%');
            $arrFilter['keyword'] = $keyword;
        }
        $arrResult = $sql->orderBy('created_at', 'desc')->paginate(20);
        $arrResult->appends($arrFilter);
        // dd($arrResult[0]->parentcategory);
        // dd($arrResult);
        if($arrResult->total() > 0){
            $record_start = (($arrResult->currentPage()-1)*$arrResult->perPage())+1;
            $record_end = ($arrResult->currentPage()*$arrResult->perPage());
            if($record_end > $arrResult->total()) $record_end = $arrResult->total();
            $str_show_record = 'Hiển thị dòng '.$record_start.' đến '.$record_end.' của '.$arrResult->total().' dòng';
        }
        $data = array(
            'page_title'        => 'Post',
            'titlePage'         => 'Quản lý Dịch Vụ',

            'nav_main'          => 'service',
            'nav_sub'           => 'service-index',
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
            'page_title'        => 'Post',
            'titlePage'         => 'Thêm/Sửa Dịch Vụ',

            'nav_main'          => 'service',
            'nav_sub'           => 'service-index',
            'strControler'      => $this->controller_name,
            'lst_catalog'       => $this->lst_catalog
        );
        $id = isset($request->id)?$request->id:0;
        settype($id, 'int');
        if($id > 0){
            $arrResult = Post::findOrfail($id);
            if($arrResult){
                $arrResult->parent = $arrResult->catalog_id;
                if($arrResult->catalogsubsub_id > 0)
                    $arrResult->parent = $arrResult->catalogsubsub_id;
                elseif($arrResult->catalogsub_id > 0)
                    $arrResult->parent = $arrResult->catalogsub_id;

                $arrResult->seo = json_decode($arrResult->seo);
                $arrResult->more_info = json_decode($arrResult->option->more_info);
                $arrResult->template = json_decode($arrResult->option->more_info)->template;
                $arrTags = json_decode($arrResult->tags);
                $arrResult->tags = (is_array($arrTags) && count($arrTags) > 0)?implode(",", $arrTags):'';
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
            'title'                             => 'required',
            'file_thumbnail'                    => "nullable|mimes:".Config::get('website.allowFileImage')."|max:10000",
            'file_seo_image'                    => "nullable|mimes:".Config::get('website.allowFileImage')."|max:10000",
            'file_header_banner_pc'             => "nullable|mimes:".Config::get('website.allowFileImage')."|max:10000",
            'file_header_banner_mobile'         => "nullable|mimes:".Config::get('website.allowFileImage')."|max:10000",
            'slug'                              => [Rule::unique('mk_post')->ignore($request->id)],
        ]);

        if ($validator->fails()) {
            $error = implode('<br>', $validator->errors()->all());
            flash($error)->error();
            return  back()->withErrors($validator)->withInput();
        }else{

            $title                  = isset($request->title)                    ?$request->title:'';
            $slug                   = isset($request->slug)                     ?$request->slug:'';
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
            $special                 = isset($request->special)                  ?$request->special:0;
            $parent                 = isset($request->parent)                   ?$request->parent:1;
            $template               = isset($request->template)                 ?$request->template:1;
            $tags                   = isset($request->tags)                     ?$request->tags:'';

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
            $special                 = FCommon::ClearStr($special);
            $tags                   = FCommon::ClearStr($tags);
            $arrTags = explode(",", $tags);

            if($status == 'on') $status = 1;
            if($special == 'on') $special = 1;

            if($parent > 0){
                $cat_info = Catalog::findOrfail($parent);
                if($cat_info->parentcategory){
                    $tem_cat = $cat_info->parentcategory;
                    if($tem_cat->parentcategory){
                        $catalog_id = $tem_cat->parentcategory->id;
                        $catalogsub_id = $cat_info->parentcategory->id;
                        $catalogsubsub_id = $cat_info->id;
                    }else{
                        $catalog_id = $cat_info->parentcategory->id;
                        $catalogsub_id = $cat_info->id;
                        $catalogsubsub_id = 0;
                    }
                }else{
                    $catalog_id = $cat_info->id;
                    $catalogsub_id = 0;
                    $catalogsubsub_id = 0;
                }
            }else{
                $catalog_id = 0;
                $catalogsub_id = 0;
                $catalogsubsub_id = 0;
            }




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

            $arrSeo = array(
                'title'         => !empty($seo_title)?$seo_title:$title,
                'description'   => $seo_description,
                'keyword'       => $seo_keyword,
                'image'         => $seo_image,
            );
            $arrInfo = array(
                'header_banner_pc'  => $header_banner_pc,
                'header_banner_mobile'  => $header_banner_mobile,
                'template'  => $template
            );

            $id = isset($request->id)?$request->id:0;
            settype($id, 'int');
            if($id > 0){
                $objToDo = Post::findOrfail($id);
                $objToDoOption = PostOption::where('post_id', $id)->first();
            }else{
                $objToDo = new Post;
                $objToDoOption = new PostOption;
            }

            $objToDo->title             = $title;
            $objToDo->slug              = !empty($slug)?$slug:Str::slug($title);
            $objToDo->summary           = $summary;
            $objToDo->content           = $content;
            $objToDo->thumbnail         = $thumbnail;
            $objToDo->seo               = json_encode($arrSeo);
            $objToDo->public_date       = FCommon::conver_date($public_date);
            $objToDo->catalog_id        = $catalog_id;
            $objToDo->catalogsub_id     = $catalogsub_id;
            $objToDo->catalogsubsub_id  = $catalogsubsub_id;
            $objToDo->status            = $status;
            $objToDo->special           = $special;
            $objToDo->group             = $this->group;
            $objToDo->user_id           = $request->session()->get('user_id');
            $objToDo->tags              = json_encode($arrTags, JSON_UNESCAPED_UNICODE);

            if($objToDo->save()){

                $objToDoOption->post_id = $objToDo->id;
                $objToDoOption->more_info = json_encode($arrInfo);
                $objToDoOption->save();

                LogActivity::addToLog('Thêm Post mới - '.$objToDo->id, $objToDo);
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
            $page = Post::findOrfail($id);
            if($page){
                $page->delete();
            }
            return back();
        }

    }
}
