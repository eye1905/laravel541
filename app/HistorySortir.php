<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorySortir extends Model
{
    public function beli()
   	{
        return $this->hasMany('App\Detailbeli');
   	}
}
