<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryPengeringan extends Model
{
	protected $table = "history_pengeringans";
	
    public function detailbelis()
   	{
        return $this->hasMany('App\Detailbeli');
   	}
}
