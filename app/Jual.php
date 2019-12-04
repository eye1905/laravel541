<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jual extends Model
{
    public function detailjuals()
   	{
        return $this->hasMany('App\Detailjual');
   	}
   	 public function konsumens()
   	{
        return $this->belongsTo('App\Konsumen', 'id_konsumen');
   	}
   	 public function users()
   	{
        return $this->belongsTo('App\User', 'id_users');
   	}

    public function currencies()
    {
        return $this->belongsTo('App\Currency', 'id_currencies');
    }
}
