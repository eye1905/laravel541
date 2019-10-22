<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryRaw extends Model
{	
	protected $table = "HystoriRaw";

    public function detailbelis()
   	{
        return $this->belongsTo('App\Detailbeli', 'iddetail');
   	}
}
