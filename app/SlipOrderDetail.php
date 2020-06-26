<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlipOrderDetail extends Model
{
    protected $guarded=[];

    public function barang() {
    	return $this->hasOne('App\Barang','id_barang','id_barang');
    }
}
