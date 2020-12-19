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
use App\Model\NapThe, App\Model\LogCallback, App\Model\User, App\Model\LichSuGiaoDich;

use Excel;
use App\Helpers\Data\NapTheExport;
use Maatwebsite\Excel\Concerns\FromCollection;

class NapTheController extends BaseController
{
    protected $time_now, $controller_name, $apikey, $urlcallback;
    public function __construct()
    {
        $this->time_now = Carbon::now();
        $this->controller_name = 'napthe';
        $this->apikey = '31b11f3b-2f09-4da6-847f-34fa5e7b5916';
        $this->urlcallback = route('frontend.napthe.callback');
    }

    public function index(Request $request, $page = 1)
    {
        $status         = isset($request->status)?$request->status:-1;
        $arrResult = NapThe::where('callback_status', '=', $status)->paginate(1);
        $arrResult->appends(['status' => $status]);

        // dd($arrResult);
        $data = array(
            'page_title'        => 'Thẻ cào',
            'page_description'  => 'Quản lý thẻ cào',
            'titlePage'         => 'Quản lý thẻ cào',

            'nav_main'          => 'dichvu',
            'nav_sub'           => 'napthe',

            'arrResult'         => $arrResult,
            'str_show_record'   => isset($str_show_record)?$str_show_record:'',
        );
        return view("backend/$this->controller_name/list", $data);




        $arr_param      = array();
        $cardcode       = isset($request->cardcode)?$request->cardcode:'';
        $madoisoat      = isset($request->madoisoat)?$request->madoisoat:'';
        $cardseri       = isset($request->cardseri)?$request->cardseri:'';
        $status         = isset($request->status)?$request->status:-1;
        $network        = isset($request->network)?$request->network:-1;
        $daterange      = isset($request->daterange)?$request->daterange:'';
        $keywork        = isset($request->keywork)?$request->keywork:'';
        $page           = isset($request->page)?$request->page:1;
        $export         = isset($request->export)?$request->export:0;

        $cardcode = FCommon::XoaDinhDang($cardcode);
        $madoisoat = FCommon::XoaDinhDang($madoisoat);
        $cardseri = FCommon::XoaDinhDang($cardseri);
        $daterange = FCommon::XoaDinhDang($daterange);
        $keywork = FCommon::XoaDinhDang($keywork);
        settype($status, 'int');
        settype($network, 'int');

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

        
        if(!empty($cardcode)) $arr_param['cardcode'] = $cardcode;
        if(!empty($madoisoat)) $arr_param['madoisoat'] = $madoisoat;
        if(!empty($cardseri)) $arr_param['cardseri'] = $cardseri;
        if(!empty($keywork)) $arr_param['keywork'] = $keywork;

        if($status != -1){
            if($status == 0) {$arrStatus = array(-1,0); $arr_param['callback_status'] = $arrStatus;}
            if($status == 1) {$arrStatus = array(1,2,3); $arr_param['callback_status'] = $arrStatus;}
            if($status == 2) {$arrStatus = array(5); $arr_param['callback_status'] = $arrStatus;}
            $arr_param['status'] = $status;
        }
        if($network != -1) $arr_param['network'] = $network;
        
        if(isset($date_from) && !empty($date_from)){
            $arr_param['date_from'] = $date_from;
            $arr_param['date_to'] = isset($date_to)?$date_to:'';
        }

        if(isset($date_to) && !empty($date_to)){
            $arr_param['date_to'] = $date_to;
            $arr_param['date_from'] = isset($date_from)?$date_from:'';
        }

        $url = route("admin.$this->controller_name.index").'?'.http_build_query($arr_param);
        //var_dump( $arr_param);
        
        if(isset($export) && $export == 1){
            $arrResult = NapThe::_list_search(0, 0, $count_row, $arr_param, $member_id, $_static);
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
        
        $arrResult = NapThe::_list_search(($start * $limit), $limit, $count_row, $arr_param, $member_id, $_static);
        // dd($arrResult);
        if($count_row > $limit){
            $breadcrumb = FCommon::breadcrumb_search($url, $count_row, $page, $limit, 2);
        }

        if($count_row > 0){
            $record_start = (($page-1)*$limit)+1;
            $record_end = ($page*$limit);
            if($record_end > $count_row) $record_end = $count_row;
            $str_show_record = 'Hiển thị dòng '.$record_start.' đến '.$record_end.' của '.$count_row.' dòng';
        }

        $data = array(
            'page_title'        => 'Thẻ cào',
            'page_description'  => 'Quản lý thẻ cào',
            'titlePage'         => 'Quản lý thẻ cào',

            'nav_main'          => 'dichvu',
            'nav_sub'           => 'napthe',

            'arrResult'         => $arrResult,
            'totalResult'       => $count_row,
            'breadcrumb'        => $breadcrumb,
            'arr_param'         => $arr_param,
            'static'            => $_static,
            'str_show_record'   => isset($str_show_record)?$str_show_record:'',
        );
        return view("backend/$this->controller_name/list")->with($data);
    }

    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'network' => 'required',
            'cardvalue' => 'required',
            'cardcode' => 'required|string|min:6|max:100',
            'cardseri' => 'required|string|min:6|max:100',
        ]);

        if ($validator->fails()) {
            foreach($validator->errors()->all() as $error){
                flash($error)->error();
            }
            return  back()->withErrors($validator)->withInput();
        }else{
            
            $network             = isset($request->network)             ?$request->network:0;
            $cardvalue           = isset($request->cardvalue)           ?$request->cardvalue:0;
            $cardcode            = isset($request->cardcode)            ?$request->cardcode:'';
            $cardseri            = isset($request->cardseri)            ?$request->cardseri:'';

            settype($cardvalue, 'int');
            $network = strip_tags(trim($network));
            $cardcode = strip_tags(trim($cardcode));
            $cardseri = strip_tags(trim($cardseri));

            $napthe = new NapThe;
            $napthe->network    = $network;
            $napthe->cardvalue  = $cardvalue;
            $napthe->cardcode   = $cardcode;
            $napthe->cardseri   = $cardseri;
            $napthe->member_id  = $request->session()->get('user_id');
            $napthe->fullname   = $request->session()->get('user_fullname');

            $data = array('status' => 0,'msg' => 'That bai roi');

            if($napthe->save()){
                $trandsID = $napthe->id.time().uniqid();
                $resSendCard = FCommon::SendCardKemeno($network, $cardcode, $cardseri, $cardvalue, $trandsID, $this->urlcallback, $this->apikey);
                
                if(!empty($resSendCard) && $resSendCard != null ){
                    $resultSendCard = json_decode($resSendCard);
                    if($resultSendCard != null){
                        $napthe->result_send = $resSendCard;
                        $napthe->trandid = $trandsID;
                        $napthe->status = $resultSendCard->Code;
                        $napthe->save();
                        LogActivity::addToLog('Nạp thẻ cào', $napthe);

                        $data = array(
                            'status'    => $resultSendCard->Code,
                            'msg'       => $resultSendCard->Message
                        );
                    }
                }
            }
        }
        flash('Thêm thành công')->success();
        return  back();
    }
    public function callback(Request $request)
    {
        $code       = isset($request->Code)             ?$request->Code:0;
        $mess       = isset($request->Mess)             ?$request->Mess:'';
        $reason     = isset($request->Reason)           ?$request->Reason:'';
        $cardvalue  = isset($request->CardValue)        ?$request->CardValue:'';
        $TrxID      = isset($request->TrxID)            ?$request->TrxID:'';

        settype($code, 'int');
        settype($cardvalue, 'float');
        $mess = strip_tags(trim($mess));
        $reason = strip_tags(trim($reason));
        $TrxID = (trim($TrxID));

        $napthe = NapThe::where('trandid', $TrxID)->firstOrFail();
        LogActivity::addToLog('Da vao roi', 'vao choi thoi');
        if(!in_array($napthe->callback_status, array(1,2,3,5))){
            $logcallback = new LogCallback;
            $logcallback->code       = $code;
            $logcallback->mess       = $mess;
            $logcallback->reason     = $reason;
            $logcallback->cardvalue  = $cardvalue;
            $logcallback->trandid    = $TrxID;
            $logcallback->id_napthe  = $napthe->id;

            LogActivity::addToLog('Callback thẻ cào', json_encode($logcallback));
            
            if($logcallback->save()){

                $napthe = NapThe::where('trandid', $TrxID)->firstOrFail();
                $info_member = User::findOrfail($napthe->member_id);
                
                $napthe->callback_cardvalue     = $cardvalue;
                $napthe->callback_status        = $code;
                $napthe->callback_message       = $reason;
                $napthe->callback_time          = $this->time_now;
                $napthe->callback_result        = $logcallback;
                $napthe->id_logcallback         = $logcallback->id;
                $napthe->chietkhau              = $info_member[$napthe->network];
                $napthe->thucdung               = ((100 - $info_member[$napthe->network])/100 * $cardvalue );

                if($napthe->save()){
                    if(in_array($code, array(1,2,3))){
                        //var_dump('ngon2');
                        $info_member = User::findOrfail($napthe->member_id);

                        $lichsu = new LichSuGiaoDich;
                        $lichsu->user_id    = $info_member->id;
                        $lichsu->type       = 1;
                        $lichsu->giatri     = $napthe->thucdung;
                        $lichsu->dauvao     = $info_member->tiensau;
                        $lichsu->daura      = $info_member->tiensau + $napthe->thucdung;
                        $lichsu->noidung    = 'Nạp thẻ '.$napthe->cardcode.'('.$napthe->network.')';

                        if($lichsu->save()){
                            LogActivity::addToLog('Ghi nhan lich su', json_encode($lichsu));

                            $info_member->tientruoc = $info_member->tiensau;
                            $info_member->tiensau   = $info_member->tiensau + $napthe->thucdung;
                            $info_member->save();
                            LogActivity::addToLog('Callback cập nhật tiền', json_encode($info_member));
                        }
                    }
                    
                }
                if($napthe->type == 2){
                    $urlcallback = $napthe->urlcallback;
                    $arrParam = array(
                        'Code'          => urlencode($napthe->callback_status),
                        'Mess'          => urlencode($logcallback->mess),
                        'Reason'        => urlencode($logcallback->reason),
                        'CardValue'     => urlencode($napthe->callback_cardvalue),
                        'TrxID'         => urlencode($napthe->trandsid_api),
                        'APIKey'         => urlencode($info_member->apikey),
                    );
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $urlcallback."?".http_build_query($arrParam),
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                }
            }
        }

        
        
    }

}
