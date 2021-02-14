<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    protected $fillable = [
        'as', 'subject', 'description', 'url', 'method', 'ip', 'agent', 'user_id'
    ];
}
