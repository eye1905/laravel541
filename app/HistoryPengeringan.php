<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryPengeringan extends Model
{
    public function detailbelis()
   	{
        return $this->hasMany('App\Detailbeli');
   	}
}
