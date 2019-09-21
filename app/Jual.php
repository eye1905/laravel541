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
   	 public function karyawans()
   	{
        return $this->belongsTo('App\Karyawan', 'id_karyawan');
   	}

    public function currencies()
    {
        return $this->belongsTo('App\Currency', 'id_currencies');
    }
}
