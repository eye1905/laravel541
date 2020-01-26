<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryStok extends Model
{
	protected $table = "history_stok";
	
    public function barang()
   	{
        return $this->belongsTo('App\Barang', 'id_barang');
   	}
}
