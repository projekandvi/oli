<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $guarded=[];
    public $timestamps = true;

    public function bank()
    {
        return $this->hasOne('App\MasterBank', 'kode_bank','id_bank');
    }
}
