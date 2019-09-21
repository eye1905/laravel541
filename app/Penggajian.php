<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
     public function karyawans()
    {
        return $this->belongsTo('App\Karyawan', 'id_karyawan');
    }
}
