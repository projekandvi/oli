<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LokasiBarang extends Model
{
    protected $guarded=[];

    public function barang() {
    	return $this->hasOne('App\Barang','id_barang','id_barang');
    }

    public function gudang() {
    	return $this->hasOne('App\Gudang','id','id_gudang');
    }
}
