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
use App\Model\NapThe, App\Model\User, App\Model\LichSuGiaoDich;

use Excel;
use App\Helpers\Data\NapTheExport;
use Maatwebsite\Excel\Concerns\FromCollection;

class TaiKhoanController extends BaseController
{
    protected $time_now, $controller_name, $apikey, $urlcallback;
    public function __construct()
    {
        $this->time_now = Carbon::now();
        $this->controller_name = 'taikhoan';
        $this->apikey = '31b11f3b-2f09-4da6-847f-34fa5e7b5916';
        $this->urlcallback = route('frontend.napthe.callback');
    }

    public function history(Request $request, $page = 1)
    {
        $arr_param      = array();
        $keywork       = isset($request->keywork)?$request->keywork:'';
        $type       = isset($request->type)?$request->type:-1;
        $daterange      = isset($request->daterange)?$request->daterange:'';
        $page           = isset($request->page)?$request->page:1;
        $export           = isset($request->export)?$request->export:0;

        $arr_date = explode(' - ', $daterange);
        if(is_array($arr_date) && count($arr_date) == 2){
            $date_from = FCommon::conver_date($arr_date[0]);
            $date_to = FCommon::conver_date($arr_date[1]);
        }

        //setup phân trang
        $start = $page-1;
        $limit = 40;
        $breadcrumb = '';

        if($request->session()->get('user_group') == 1)
            $member_id = -1;
        else
            $member_id = $request->session()->get('user_id');




        settype($type, 'int');
        if(!empty($keywork)) $arr_param['keywork'] = $keywork;
        $arr_param['type'] = $type;

        if(isset($date_from) && !empty($date_from)){
            $arr_param['date_from'] = $date_from;
            $arr_param['date_to'] = isset($date_to)?$date_to:'';
        }

        if(isset($date_to) && !empty($date_to)){
            $arr_param['date_to'] = $date_to;
            $arr_param['date_from'] = isset($date_from)?$date_from:'';
        }

        $url = route("admin.$this->controller_name.giaodich").'?'.http_build_query($arr_param);
        // dd( $arr_param);
        
        if(isset($export) && $export == 1){
            $arrResult = NapThe::_list_search(0, 0, $count_row, $arr_param, $member_id);
            foreach($arrResult as $item){

                if ($item->callback_status == 1) $trangthai = 'Thẻ đúng';
                elseif($item->callback_status == 2 || $item->callback_status == 3) $trangthai = 'Thẻ sai mệnh giá';
                elseif($item->callback_status == 5) $trangthai = 'Thẻ sai';
                else $trangthai = 'Đang xử lý';

                $doitac = ($request->session()->get('user_group') == 1)?$item->fullname:'';
                $doisoat = (isset($item->trandsid_api) && !empty($item->trandsid_api))?$item->trandsid_api:$item->trandid;
                
                $data[] = array(
                    $item->created_at,
                    $doisoat,
                    FCommon::showNameNetwork($item->network),
                    $item->cardcode,
                    $item->cardseri,
                    $item->cardvalue,
                    $item->callback_cardvalue,
                    $item->chietkhau.'%',
                    $item->thucdung,
                    $trangthai,
                    $doitac,
                );
            }
            
            $export = new NapTheExport($data);
            return Excel::download($export, ' tuanxuong.xlsx');
        }
        
        $arrResult = LichSuGiaoDich::_list_search(($start * $limit), $limit, $count_row, $arr_param, $member_id);
        // dd($arrResult);
        if($count_row > $limit){
            $breadcrumb = FCommon::breadcrumb_search($url, $count_row, $page, $limit, 2);
        }

        $data = array(
            'page_title'        => 'Lịch sử giao dịch',
            'page_description'  => 'Quản lý Lịch sử giao dịch',
            'titlePage'         => 'Quản lý Lịch sử giao dịch',

            'nav_main'          => 'taikhoan',
            'nav_sub'           => 'lichsugiaodich',

            'arrResult'         => $arrResult,
            'totalResult'       => $count_row,
            'breadcrumb'        => $breadcrumb,
            'arr_param'         => $arr_param,
        );
        return view("backend/$this->controller_name/history")->with($data);
    }

}
