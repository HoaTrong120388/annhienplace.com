<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Group extends Model
{
    protected $table = 'mk_users_group';
    public $timestamps = false;

    public function user()
    {
        return $this->hasMany(User::class, 'idgroup', 'id');
    }
    public static function _detail($id){
        return  DB::table('mk_users_group')
                ->where('id', $id)
                ->first();
    }
    public static function _list(){
        return  DB::table('mk_users_group')
                ->select()
                ->orderBy('id', 'asc')
                ->get();
    }
    public static function _add($data){
        return  DB::table('mk_users_group')->insertGetId($data);
    }
    public static function _edit($id, $data){
        return  DB::table('mk_users_group')
            ->where('id', $id)
            ->update($data);
    }
    public static function _delete($id){
        return DB::table('mk_users_group')->where('id', '=', $id)->delete();
    }
}
