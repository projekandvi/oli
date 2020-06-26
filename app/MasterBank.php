<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterBank extends Model
{
    protected $guarded=[];

    public function uangnya() {
    	return $this->hasMany('App\Pembayaran','id_bank','kode_bank');
    }


}
