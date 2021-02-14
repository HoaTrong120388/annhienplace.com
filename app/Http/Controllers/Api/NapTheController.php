<?php

namespace App\Http\Controllers\Api;

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
use App\Model\NapThe, App\Model\LogCallback, App\Model\User;

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

    public function send(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'network' => 'required',
        //     'cardvalue' => 'required',
        //     'cardcode' => 'required|string|min:6|max:100',
        //     'cardseri' => 'required|string|min:6|max:100',
        //     'apikey' => 'required|string|min:10|max:200',
        //     'urlcallback' => 'required|string|min:10|max:255',
        //     'trandsid' => 'required|string',
        // ]);

        $validator = Validator::make($request->all(), [
            'Network' => 'required',
            'CardValue' => 'required',
            'CardCode' => 'required|string|min:6|max:100',
            'CardSeri' => 'required|string|min:6|max:100',
            'APIKey' => 'required|string|min:10|max:200',
            'URLCallback' => 'required|string|min:10|max:255',
            'TrxID' => 'required|string',
        ]);

        if ($validator->fails()) {
            $error_val = $validator->errors();
            $data = array(
                'status' => 0,
                'msg' => 'Lỗi, hệ thống từ chối thẻ này | line 49',
                'loi'	=> $error_val->all()
            );
        }else{
            
            $network             = isset($request->Network)             ?$request->Network:0;
            $cardvalue           = isset($request->CardValue)           ?$request->CardValue:0;
            $cardcode            = isset($request->CardCode)            ?$request->CardCode:'';
            $cardseri            = isset($request->CardSeri)            ?$request->CardSeri:'';
            $apikey              = isset($request->APIKey)              ?$request->APIKey:'';
            $urlcallback         = isset($request->URLCallback)         ?$request->URLCallback:'';
            $trandsid_api        = isset($request->TrxID)            ?$request->TrxID:'';

            settype($cardvalue, 'int');
            $network = strip_tags(trim($network));
            $cardcode = strip_tags(trim($cardcode));
            $cardseri = strip_tags(trim($cardseri));
            $apikey = strip_tags(trim($apikey));
            $urlcallback = strip_tags(trim($urlcallback));
            $trandsid_api = strip_tags(trim($trandsid_api));


            $find_user = User::where('apikey', $apikey)->count();
            if($find_user == 1){
                $info_user = User::where('apikey', $apikey)->firstOrFail();

                $napthe = new NapThe;
                $napthe->network        = $network;
                $napthe->cardvalue      = $cardvalue;
                $napthe->cardcode       = $cardcode;
                $napthe->cardseri       = $cardseri;
                $napthe->member_id      = $info_user->id;
                $napthe->fullname       = $info_user->fullname;
                $napthe->type           = 2;
                $napthe->urlcallback    = $urlcallback;
                $napthe->trandsid_api   = $trandsid_api;

                $data = array(
                    'status'    => 0,
                    'msg'       => 'Lỗi, hệ thống từ chối thẻ này | line 113',
                );
                if($napthe->save()){
                    $trandsID = $napthe->id.time().uniqid();
                    //var_dump($trandsID);
                    //$trandsID = $trandsid_api;
                    $resSendCard = FCommon::SendCardKemeno($network, $cardcode, $cardseri, $cardvalue, $trandsID,$this->urlcallback,$this->apikey);
                    if(!empty($resSendCard) && $resSendCard != null ){
                        $resultSendCard = json_decode($resSendCard);
                        if($resultSendCard != null){
                            $napthe->result_send = $resSendCard;
                            $napthe->trandid = $trandsID;
                            $napthe->status = $resultSendCard->Code;
                            $napthe->save();
                            LogActivity::addToLog('Api nạp thẻ cào', $napthe);

                            $data = array(
                                'status'    => $resultSendCard->Code,
                                'msg'       => $resultSendCard->Message
                            );
                        }
                    }
                }
            }else{
                $data = array(
                    'status' => 0,
                    'msg' => 'Lỗi, không đúng tham số | line 119'
                );
            }
            
        }
        return response()->json($data);
    }
}
