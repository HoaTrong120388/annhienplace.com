<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LogCallback extends Model
{
    public function napthe(){
		return $this->belongsTo(NapThe::class, 'id_logcallback', 'id');
	}
}
