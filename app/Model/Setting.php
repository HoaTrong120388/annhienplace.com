<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Setting extends Model
{
    protected $table = 'mk_setting';
    public $timestamps = false;

    public static function _detail($key){
        return  DB::table('mk_setting')
                ->where('id', $key)
                ->orwhere('key_setting', $key)
                ->first();
    }
    public static function _list(){
        return  DB::table('mk_setting')
                ->select()
                ->orderBy('id', 'asc')
                ->get();
    }
    public static function _add($data){
        return  DB::table('mk_setting')->insertGetId($data);
    }
    public static function _edit($id, $data){
        return  DB::table('mk_setting')
            ->where('id', $id)
            ->update($data);
    }
    public static function _update($name, $value, $id){
        return  DB::table('mk_setting')
                ->where('id', $id)
                ->update([$name => $value]);
    }
}
