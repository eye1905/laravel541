<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    public function belis()
   	{
        return $this->hasMany('App\Beli');
   	}
   	public function juals()
   	{
        return $this->hasMany('App\Jual');
   	}
   	public function proses()
   	{
        return $this->hasMany('App\Proses');
   	}
    public function users()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
    public function penggajians()
    {
        return $this->hasMany('App\Penggajian');
    }
}
