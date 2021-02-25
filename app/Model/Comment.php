<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Comment extends Model
{
    protected $table = 'mk_comment';

    public function post(){
        return $this->hasOne(Post::class);
    }
    public function lstchild(){
        return $this->hasMany(Comment::class, 'parent');
    }
}
