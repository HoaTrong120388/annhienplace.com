<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Post extends Model
{
    protected $table = 'mk_post';
    public function authr()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function option()
    {
        return $this->hasOne(PostOption::class);
    }
    public function parentcategory(){
        return $this->hasOne(Catalog::class, 'id', 'catalog_id');
    }
    public function subcategory(){
        return $this->hasOne(Catalog::class, 'id', 'catalogsub_id');
    }
    public function subsubcategory(){
        return $this->hasOne(Catalog::class, 'id', 'catalogsubsub_id');
    }
    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public static function _list_post_nav($cat_id, $group = 1, $language = 'vi'){
        $arrResult = DB::table('mk_post as p')
                    ->select(DB::raw('p.id, p.title, p.slug, p.thumbnail'))
                    ->where('group', $group)
                    ->where('language', $language)
                    ->where(function ($q) use ($cat_id) {
                        $q->where('catalog_id', $cat_id)->orWhere('catalogsub_id', $cat_id);
                    })
                    ->where('status', 1)
                    ->orderBy('order', 'asc')
                    ->orderBy('id', 'desc')
                    ->get();
        return $arrResult;
    }
}
