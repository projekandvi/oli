<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryOrderDetail extends Model
{
    protected $guarded=[];

    public function do() {
    	return $this->hasOne('App\DeliveryOrder','id_do','id_do');
    }

    public function lokasi() {
    	return $this->hasOne('App\LokasiBarang','id','lokasi_keluar_barang');
    }
}
