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
    public function lstPost(){
        return $this->hasMany(Post::class);
    }

}
