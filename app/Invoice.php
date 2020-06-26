<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $primaryKey = 'id_invoice';
    public $incrementing = false;

    protected $guarded=[];

    public function barang() {
    	return $this->hasOne('App\Barang','id_barang','id_barang');
    }

    public function payment() {
    	return $this->hasMany('App\Payment','id_invoice','id_invoice');
    }

    public function tampung() {
    	return $this->hasMany('App\Tampung','id_invoice','id_invoice');
    }

}
