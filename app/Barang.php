<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    public function detailbelis()
   	{
        return $this->hasMany('App\Detailbeli');
   	}
   	public function detailjuals()
   	{
        return $this->hasMany('App\Detailjual');
   	}
   	public function detailproses()
   	{
        return $this->hasMany('App\Detailproses');
   	}
      public function getbarang()
    {
      $sql = "select id,stok,harga,hpp from barangs";
      $a_data = DB::select($sql);
      return $a_data;
    }
}
