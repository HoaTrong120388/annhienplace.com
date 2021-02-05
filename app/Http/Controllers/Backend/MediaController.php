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
use App\Model\Libary, App\Model\User;

class MediaController extends BaseController
{
    protected $time_now, $controller_name, $lst_catalog;
    public function __construct()
    {
        $this->time_now = Carbon::now();
        $this->controller_name = 'media';
        $this->lst_catalog = array(
            1   => 'Slider',
            2   => 'Không gian',
            3   => 'Banner'
        );
    }

    public function index(Request $request)
    {
        $keyword         = isset($request->keyword)?$request->keyword:'';
        $keyword = FCommon::ClearStr($keyword);
        $arrFilter = array();

        $sql = Libary::where('id', '>', 0);
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
            'page_title'        => 'Media',
            'titlePage'         => 'Quản lý hình ảnh',

            'nav_main'          => 'media',
            'nav_sub'           => 'media',
            'strControler'      => $this->controller_name,

            'arrResult'         => $arrResult,
            'arrFilter'         => $arrFilter,
            'lst_catalog'       => $this->lst_catalog,
            'str_show_record'   => isset($str_show_record)?$str_show_record:''
        );
        return view("backend/$this->controller_name/list", $data);
    }
    public function todo(Request $request)
    {
        $data = array(
            'page_title'        => 'Media',
            'titlePage'         => 'Thêm/Sửa Hình ảnh',

            'nav_main'          => 'media',
            'nav_sub'           => 'media',
            'lst_catalog'       => $this->lst_catalog,
            'strControler'      => $this->controller_name,
        );

        $id = isset($request->id)?$request->id:0;
        settype($id, 'int');
        if($id > 0){
            $arrResult = Libary::findOrfail($id);
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
            'file_thumbnail'            => "nullable|mimes:".Config::get('website.allowFileImage')."|max:10000",
        ]);

        if ($validator->fails()) {
            $error = implode('<br>', $validator->errors()->all());
            flash($error)->error();
            return  back()->withErrors($validator)->withInput();
        }else{

            $title                  = isset($request->title)                    ?$request->title:'';
            $link                   = isset($request->link)                     ?$request->link:'';
            $thumbnail              = isset($request->thumbnail)                ?$request->thumbnail:'';
            $status                 = isset($request->status)                   ?$request->status:0;
            $parent                 = isset($request->parent)                   ?$request->parent:1;
            $summary                = isset($request->summary)                   ?$request->summary:1;

            settype($parent, 'int');

            $title                  = FCommon::ClearStr($title);
            $thumbnail              = FCommon::ClearStr($thumbnail);
            $link                   = FCommon::ClearStr($link);
            $status                 = FCommon::ClearStr($status);
            $summary                = FCommon::ClearStr($summary);
            if($status == 'on') $status = 1;

            if ($request->hasFile('file_thumbnail')) {
                $ext = $request->file_thumbnail->getClientOriginalExtension();
                if(FCommon::check_file_upload($ext, 'image')){
                    $file_file_thumbnail = $request->file('file_thumbnail');
                    $thumbnail = FCommon::upload_file_crop($file_file_thumbnail, '200x200');
                    // dd($thumbnail);
                }
            }

            $id                  = isset($request->id)                    ?$request->id:0;
            settype($id, 'int');
            if($id > 0){
                $libary = Libary::findOrfail($id);
            }else{
                $libary = new Libary;
            }

            $libary->title = $title;
            $libary->slug = Str::slug($title);
            $libary->link = $link;
            $libary->thumbnail = $thumbnail;
            $libary->status = $status;
            $libary->parent = $parent;
            $libary->summary = $summary;
            // dd($libary);

            if($libary->save()){
                LogActivity::addToLog('Thêm media mới - '.$libary->id, $libary, 4);
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
            $page = Libary::findOrfail($id);
            if($page){
                $page->delete();
            }
            return back();
        }

    }
}
