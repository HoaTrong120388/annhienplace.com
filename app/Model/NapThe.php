<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class Napthe extends Model
{   
    protected $casts = [
        'cardvalue' => 'integer',
        'cardcode' => 'string',
        'cardseri' => 'string',
    ];
    public function logcallback(){
		return $this->belongsTo(LogCallBack::class, 'id_napthe', 'id');
    }
    
    public static function _list_search($offset = 0, $limit = 0, &$count, $arr_param = array(), $member_id, &$result_static){
        //var_dump($arr_param);
        $sql = DB::table('napthes as n')->select(DB::raw('n.*'));
        $sql_static = DB::table('napthes as n')->select(DB::raw("count(id) as countall"), DB::raw("SUM(cardvalue) as totalcardvalue"), DB::raw("SUM(callback_cardvalue) as totalcardvaluecallback"),DB::raw("SUM(thucdung) as totalthucdung"));
        if(is_array($arr_param) && !empty($arr_param) && count($arr_param) > 0){
            if(isset($arr_param['date_from']) && $arr_param['date_from'] != '' || isset($arr_param['date_from']) && $arr_param['date_to'] != ''){
                if($arr_param['date_from'] == '' && $arr_param['date_to'] !=  ''){
                    $arr_param['date_from'] = $arr_param['date_to'];
                }
                if($arr_param['date_to'] == '' && $arr_param['date_from'] !=  ''){
                    $arr_param['date_to'] = $arr_param['date_from'];
                }
                $sql->whereBetween('created_at', [$arr_param['date_from'].' 00:00:00', $arr_param['date_to'].' 23:59:59']);
                $sql_static->whereBetween('created_at', [$arr_param['date_from'].' 00:00:00', $arr_param['date_to'].' 23:59:59']);
            }
            
        
            if(isset($arr_param['cardcode']) && !empty($arr_param['cardcode'])){
                $sql->where('cardcode', 'like', '%'.$arr_param['cardcode'].'%');
                $sql_static->where('cardcode', 'like', '%'.$arr_param['cardcode'].'%');
            }
            if(isset($arr_param['cardseri']) && !empty($arr_param['cardseri'])){
                $sql->where('cardseri', 'like', '%'.$arr_param['cardseri'].'%');
                $sql_static->where('cardseri', 'like', '%'.$arr_param['cardseri'].'%');
            }
            if(isset($arr_param['madoisoat']) && !empty($arr_param['madoisoat'])){
                $sql->where('trandsid_api', 'like', '%'.$arr_param['madoisoat'].'%')->orWhere('trandid', 'like', '%'.$arr_param['madoisoat'].'%');
                $sql_static->where('trandsid_api', 'like', '%'.$arr_param['madoisoat'].'%')->orWhere('trandid', 'like', '%'.$arr_param['madoisoat'].'%');
            }
            if(isset($arr_param['keywork']) && !empty($arr_param['keywork'])){
                $sql->where('trandsid_api', 'like', '%'.$arr_param['keywork'].'%')->orWhere('trandid', 'like', '%'.$arr_param['keywork'].'%')->orWhere('cardseri', 'like', '%'.$arr_param['keywork'].'%')->orWhere('cardcode', 'like', '%'.$arr_param['keywork'].'%');
                $sql_static->where('trandsid_api', 'like', '%'.$arr_param['keywork'].'%')->orWhere('trandid', 'like', '%'.$arr_param['keywork'].'%')->orWhere('cardseri', 'like', '%'.$arr_param['keywork'].'%')->orWhere('cardcode', 'like', '%'.$arr_param['keywork'].'%');
            }
            if(isset($arr_param['callback_status']) && count($arr_param['callback_status']) >= 0){
                $sql->whereIn('callback_status', $arr_param['callback_status']);
                $sql_static->whereIn('callback_status', $arr_param['callback_status']);
            }
            if(isset($arr_param['network']) && $arr_param['network'] != -1){
                $sql->where('network', $arr_param['network']);
                $sql_static->where('network', $arr_param['network']);
            }
            //var_dump($arr_param);
        }
        if($member_id != -1){
            $sql->where('member_id', $member_id);
            $sql_static->where('member_id', $member_id);
        }

        $count = $sql->count();
        $sql->orderBy('id', 'desc');
        if(!empty($limit) && $limit > 0){
            $arrResult = $sql->skip($offset)->take($limit)->get();
        }else{
            $arrResult = $sql->get();
        }

        $result_static = $sql_static->first();
        return $arrResult;
    }

    public static function _static_dashboard_widget_top($member_id){
        $dateS = Carbon::now()->startOfMonth();
        $dateE = Carbon::now()->endOfMonth(); 
        $dateS_pre = Carbon::now()->startOfMonth()->subMonth(1);
        $dateE_pre = Carbon::now()->endOfMonth()->subMonth(1); 

        $sql_static = DB::table('napthes as n')->select(
            DB::raw("
                count(id) as countall, 
                SUM(cardvalue) as totalcardvalue, 
                SUM(callback_cardvalue) as totalcardvaluecallback, 
                SUM(thucdung) as totalthucdung"
            )
        );
        $sql_static->whereBetween('created_at',[$dateS,$dateE])->where('member_id', $member_id);
        $arrResultThisMonth = $sql_static->first();

        $arrResultThisMonth_right = $sql_static->whereIn('callback_status', [1, 2, 3])->first();
        
        
        $sql_static_doanhthu_premonth = DB::table('napthes as n')->select(DB::raw("SUM(thucdung) as totalthucdung"))
                                            ->whereBetween('created_at',[$dateS_pre,$dateE_pre])
                                            ->where('member_id', $member_id);
        $arrResultLastMonth = $sql_static_doanhthu_premonth->first();
        

        $sql_static_network = DB::table('napthes')->select('network', DB::raw("count(id) as total"));
        $sql_static_network
                        ->whereBetween('created_at',[$dateS,$dateE])
                        ->where('member_id', $member_id)
                        ->groupBy('network');
        $arrResultStaticNetwork = $sql_static_network->get();
        
        
        $sql_static_cardvalue = DB::table('napthes')->select('cardvalue', DB::raw("count(id) as total"));
        $sql_static_cardvalue
                        ->whereBetween('created_at',[$dateS,$dateE])
                        ->where('member_id', $member_id)
                        ->groupBy('cardvalue');
        $arrResultStaticcardvalue = $sql_static_cardvalue->get();
        
        
        $sql_static_date = DB::table('napthes')->select(DB::raw('DAY(created_at) as date'), DB::raw('MONTH(created_at) as month'), DB::raw("count(id) as total"));
        $sql_static_date
                        ->whereBetween('created_at',[$dateS_pre,$dateE_pre])
                        ->where('member_id', $member_id)
                        ->groupBy('date');
        $arrResultStaticdate = $sql_static_date->get();
        // dd($arrResultStaticdate);

        return $arrResult = array(
            'arrResultThisMonth'        => $arrResultThisMonth,
            'arrResultThisMonth_right'  => $arrResultThisMonth_right,
            'arrResultLastMonth'        => $arrResultLastMonth,
            'arrResultStaticNetwork'    => $arrResultStaticNetwork,
            'arrResultStaticcardvalue'  => $arrResultStaticcardvalue,
            'arrResultStaticdate'       => $arrResultStaticdate
        );
    }
    public static function _add($data){
        return  DB::table('mk_page')->insertGetId($data);
    }
    public static function _edit($id, $data){
        return  DB::table('mk_page')
            ->where('id', $id)
            ->update($data);
    }
}
