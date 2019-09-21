<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proses extends Model
{
    public function detailproses()
   	{
        return $this->hasMany('App\Detailproses');
   	}
   	public function karyawans()
   	{
        return $this->belongsTo('App\Karyawan', 'id_karyawan');
   	}
   
}
