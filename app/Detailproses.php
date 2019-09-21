<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailproses extends Model
{
   public function proses()
   	{
        return $this->belongsTo('App\Proses', 'id_proses');
   	}
   	public function barangs()
   	{
        return $this->belongsTo('App\Barang', 'id_barang');
   	}
}
