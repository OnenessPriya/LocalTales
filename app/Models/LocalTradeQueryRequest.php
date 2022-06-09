<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalTradeQueryRequest extends Model
{
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function category() {
        return $this->belongsTo('App\Models\BusinessCategory', 'category_id', 'id');
    }
}
