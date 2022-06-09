<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function business(){
	    return $this->belongsTo(Business::class, 'directory_id', 'id');
	}
}
