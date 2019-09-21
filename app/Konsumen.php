<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    public function juals()
   	{
        return $this->hasMany('App\Jual');
   	}
}
