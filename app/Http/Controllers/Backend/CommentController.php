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
use App\Model\Comment, App\Model\Post, App\Model\User;

class CommentController extends BaseController
{
    protected $time_now, $controller_name, $controller_group, $group;
    public function __construct()
    {
        $this->time_now = Carbon::now();
        $this->controller_name = 'comment';
        $this->controller_group = 1;
    }

    public function index(Request $request)
    {
        $keyword         = isset($request->keyword)?$request->keyword:'';
        $keyword = FCommon::ClearStr($keyword);
        $arrFilter = array();

        $sql = comment::where('group', $this->controller_group)->where('parent', 0);
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
            'page_title'        => 'Comment',
            'titlePage'         => 'Quản lý đánh giá',

            'nav_main'          => 'comment',
            'nav_sub'           => 'comment-index',
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
            'page_title'        => 'Comment',
            'titlePage'         => 'Thêm/Sửa Đánh giá',

            'nav_main'          => 'comment',
            'nav_sub'           => 'comment-index',
            'strControler'      => $this->controller_name,
        );

        $id = isset($request->id)?$request->id:0;
        settype($id, 'int');
        if($id > 0){
            $arrResult = Comment::findOrfail($id);
            if($arrResult){
                $data['arrResult'] = $arrResult;

                $arrResultChild = Comment::where('parent', $arrResult->id)->first();
                $data['arrResultChild'] = $arrResultChild;
            }
        }


        return view("backend/$this->controller_name/todo", $data);
    }
    public function todosubmit(Request $request)
    {
        $id                     = isset($request->id)                    ?$request->id:0;
        $idChild                = isset($request->idChild)               ?$request->idChild:0;
        $message                = isset($request->message)               ?$request->message:'';
        $status                 = isset($request->status)                ?$request->status:0;
        $fullname_reply         = isset($request->fullname_reply)        ?$request->fullname_reply:'';
        $message_reply          = isset($request->message_reply)         ?$request->message_reply:'';

        settype($id, 'int');
        settype($idChild, 'int');
        $message               = FCommon::ClearStr($message);
        $fullname_reply        = FCommon::ClearStr($fullname_reply);
        $message_reply         = FCommon::ClearStr($message_reply);
        $status                = FCommon::ClearStr($status);
        if($status == 'on') $status = 1;

        $objToDo = Comment::findOrfail($id);

        $objToDo->message = $message;
        $objToDo->status = $status;

        if($objToDo->save()){

            /** Update Ranking Product */
            $lstComment = Comment::where('parent', 0)->where('status', 1)->where('post_id', $objToDo->post_id)->get();
            $raking_product = FCommon::countRanking($lstComment);
            $Post = Post::findOrfail($objToDo->post_id);
            $Post->ranking = $raking_product;
            $Post->save();

            if(!empty($message_reply)){
                if($idChild > 0){
                    $objChild = Comment::findOrfail($idChild);
                }else{
                    $objChild = new Comment;
                }
                
                $objChild->fullname          = $fullname_reply;
                $objChild->message           = $message_reply;
                $objChild->post_id           = $objToDo->post_id;
                $objChild->link              = $objToDo->link;
                $objChild->group             = 1;
                $objChild->parent            = $objToDo->id;
                $objChild->status            = 1;
                $objChild->save();
            }
            

            LogActivity::addToLog('Chỉnh sửa đánh giá '. $this->controller_name .' mới - '.$objToDo->id, $objToDo, 2);
            flash('Lưu thành công')->success();
            return back();
        }else{
            flash('Có lỗi vui lòng thử lại sau')->error();
            return back();
        }

    }
    public function delete(Request $request)
    {
        $id = isset($request->id)?$request->id:0;
        settype($id, 'int');
        if($id > 0){
            $page = comment::findOrfail($id);
            if($page){
                $page->delete();
            }
            return back();
        }

    }
}
