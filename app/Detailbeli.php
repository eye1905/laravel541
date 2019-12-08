<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Detailbeli extends Model
{
    public function barangs()
   	{
        return $this->belongsTo('App\Barang', 'id_barang');
   	}
   	 public function belis()
   	{
        return $this->belongsTo('App\Beli', 'id_beli');
   	}

   	public function getbarang($id)
   	{
   		$sql = "select id_barang,sum(berat) as stok, harga from detailbelis where id_beli='".$id."' group by id_barang, harga";
   		$a_data = DB::select($sql);
   		return $a_data;
   	}
}
