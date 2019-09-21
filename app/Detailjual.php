<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailjual extends Model
{
   public function barangs()
   	{
        return $this->belongsTo('App\Barang', 'id_barang');
   	}
   	public function juals()
   	{
        return $this->belongsTo('App\Jual', 'id_jual');
   	}
}
