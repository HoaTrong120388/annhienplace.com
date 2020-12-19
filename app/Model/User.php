<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class User extends Model
{
    protected $table = 'mk_users';

    protected $hidden = ['password'];

    public function post()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }
    public function group()
    {
        return $this->hasOne(Group::class, 'id', 'idgroup');
    }

    public static function CheckEmailExit($Email){
        return DB::table('mk_users')->where('email', $Email)->exists();
    }

    public static function CheckLogin($Email, $Pass){
        return  DB::table('mk_users')
                ->where('email', $Email)
                ->where('password', $Pass)
                ->exists();
    }

    public static function GetInfoUser($Email){
        return  DB::table('mk_users')
                ->where('email', $Email)
                ->where('active', 1)
                ->first();
    }

    public static function GetInfoUserByID($id){
        return  DB::table('mk_users')
                ->where('id', $id)
                ->first();
    }
    public static function _list_search($offset = 0, $limit = 0, &$count, $arr_param = array()){
        $sql = DB::table('mk_users as u')->select(DB::raw('u.*,
                    (
                        SELECT g.name
                        FROM mk_users_group as g
                        WHERE g.id = u.idgroup
                    ) AS group_name'
                )
            );
        if(is_array($arr_param) && !empty($arr_param) && count($arr_param) > 0){
            if(isset($arr_param['keywork']) && !empty($arr_param['keywork'])){
                $sql->where('fullname', 'like', '%'.$arr_param['keywork'].'%')->orWhere('email', 'like', '%'.$arr_param['keywork'].'%')->orWhere('phone', 'like', '%'.$arr_param['keywork'].'%')->orWhere('apikey', 'like', '%'.$arr_param['keywork'].'%');
            }
        }
        $sql->where('idgroup', '<', 10001);
        $count = $sql->count();
        $sql->orderBy('id', 'desc');
        if(!empty($limit) && $limit > 0){
            $arrResult = $sql->skip($offset)->take($limit)->get();
        }else{
            $arrResult = $sql->get();
        }
        return $arrResult;
    }
    public static function Add_User($data){
        return  DB::table('mk_users')->insertGetId($data);
    }
    public static function Edit_User($id, $data){
        return  DB::table('mk_users')
            ->where('id', $id)
            ->update($data);
    }
    public static function Update_Value($name, $value, $id){
        return  DB::table('mk_users')
                ->where('id', $id)
                ->update([$name => $value]);
    }
}
