<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class LichSuGiaoDich extends Model
{   
    protected $table = 'lichsugiaodich';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function _list_search($offset = 0, $limit = 0, &$count, $arr_param = array(), $member_id){
        //var_dump($arr_param);
        $sql = DB::table('lichsugiaodich as ls')->select(DB::raw('ls.*'));
        if(is_array($arr_param) && !empty($arr_param) && count($arr_param) > 0){
            if(isset($arr_param['date_from']) && $arr_param['date_from'] != '' || isset($arr_param['date_from']) && $arr_param['date_to'] != ''){
                if($arr_param['date_from'] == '' && $arr_param['date_to'] !=  ''){
                    $arr_param['date_from'] = $arr_param['date_to'];
                }
                if($arr_param['date_to'] == '' && $arr_param['date_from'] !=  ''){
                    $arr_param['date_to'] = $arr_param['date_from'];
                }
                $sql->whereBetween('created_at', [$arr_param['date_from'].' 00:00:00', $arr_param['date_to'].' 23:59:59']);
            }
            
        
            if(isset($arr_param['keywork']) && !empty($arr_param['keywork'])){
                $sql->where('noidung', 'like', '%'.$arr_param['keywork'].'%');
            }
            if(isset($arr_param['type']) && $arr_param['type'] > 0){
                $sql->where('type', $arr_param['type']);
            }
            //var_dump($arr_param);
        }
        if($member_id != -1)
            $sql->where('user_id', $member_id);

        $count = $sql->count();
        $sql->orderBy('id', 'desc');
        if(!empty($limit) && $limit > 0){
            $arrResult = $sql->skip($offset)->take($limit)->get();
        }else{
            $arrResult = $sql->get();
        }
        // dd($arrResult)
        return $arrResult;
    }
}
