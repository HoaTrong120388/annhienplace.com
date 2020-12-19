<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Page extends Model
{
    protected $table = 'mk_page';
    public function authr()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
