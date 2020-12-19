<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Catalog extends Model
{
    protected $table = 'mk_catalog';

    public function subcategory(){
        return $this->hasMany(Catalog::class, 'parent');
    }
    public function parentcategory(){
        return $this->hasOne(Catalog::class, 'id', 'parent');
    }

    public static function _list_all_limit($group = 1, $language = 'vi'){
        $arrResult = DB::table('mk_catalog as c')
                    ->select(DB::raw('c.id, c.title, c.parent, c.slug, c.thumbnail,
                        (
                            SELECT c1.title
                            FROM mk_catalog as c1
                            WHERE c1.id = c.parent
                        ) AS parent_name,
                        (
                            SELECT count(id)
                            FROM mk_catalog as c2
                            WHERE c2.parent = c.id
                        ) AS count_child'
                    ))
                    ->where('group', $group)
                    ->where('language', $language)
                    ->where('status', 1)
                    ->orderBy('parent_name', 'asc')
                    ->orderBy('order', 'asc')
                    ->orderBy('id', 'desc')
                    ->get();
        return $arrResult;
    }
}
