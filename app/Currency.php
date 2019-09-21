<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public function juals()
   	{
        return $this->hasMany('App\Jual');
   	}
}
