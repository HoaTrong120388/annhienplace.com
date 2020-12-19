<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permissions extends Model
{
    protected $table = 'mk_permissions';
    public $timestamps = false;

    public static function _detail($id){
        return  DB::table('mk_permissions')
                ->where('id', $id)
                ->first();
    }
    public static function _list(){
        return  DB::table('mk_permissions')
                ->select()
                ->orderBy('controller', 'desc')
                ->get();
    }
    public static function _list_main($id = 0){
        return  DB::table('mk_permissions')
                ->select()
                ->where('parent', $id)
                ->orderBy('id', 'desc')
                ->get();
    }
    
    public static function _add($data){
        return  DB::table('mk_permissions')->insertGetId($data);
    }
    public static function _edit($id, $data){
        return  DB::table('mk_permissions')
            ->where('id', $id)
            ->update($data);
    }
    public static function _delete($id){
        DB::table('mk_permissions')->where('parent', '=', $id)->delete();
        return DB::table('mk_permissions')->where('id', '=', $id)->delete();
    }
    public static function _update($name, $value, $id){
        return  DB::table('mk_permissions')
                ->where('id', $id)
                ->update([$name => $value]);
    }
}
