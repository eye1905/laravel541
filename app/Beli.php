<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beli extends Model
{
    public function detailbelis()
   	{
        return $this->hasMany('App\Detailbeli');
   	}
   	public function suppliers()
   	{
        return $this->belongsTo('App\Supplier', 'id_supplier');
   	}
   	public function karyawans()
   	{
        return $this->belongsTo('App\Karyawan', 'id_karyawan');
   	}
}
