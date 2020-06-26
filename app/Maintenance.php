<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $guarded=[];
    // protected $dates = ['created_at', 'updated_at', 'tanggal_perbaikan'];

    public function so()
    {
        return $this->hasOne('App\SlipOrder', 'id_slip_order','id_slip_order');
    }

    public function customer() {
        return $this->hasOne('App\Customer', 'id', 'id_customer');
    }

    public function soDetail(){
        return $this->hasMany('App\SlipOrderDetail', 'id_slip_order','id_slip_order');
    }

    public function tek()
    {
        return $this->hasOne('App\Teknisi', 'id','id_teknisi');
    }

    public function laporanTeknisiService1()
    {
        return $this->hasOne('App\LaporanTeknisi', 'id_maintenance','id');
    }
}
