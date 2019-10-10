<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryPengeringan extends Model
{
    public function beli()
   	{
        return $this->hasMany('App\Detailbeli');
   	}
}
