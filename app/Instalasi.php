<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instalasi extends Model
{
    protected $guarded=[];

    public function barang()
    {
        return $this->hasOne('App\Barang', 'id_barang','id');
    }

    // public function customer()
    // {
    //     return $this->hasOne('App\Customer', 'id','id_customer');
    // }

    public function staf()
    {
        return $this->hasOne('App\User', 'id_staf','id');
    }

    public function tek()
    {
        return $this->hasOne('App\Teknisi', 'id','teknisi');
    }

    public function laporanTeknisiInstalasi()
    {
        return $this->hasOne('App\LaporanTeknisi', 'id_instalasi','id');
    }

    public function so(){
        return $this->hasOne('App\SlipOrder', 'id_slip_order','id_slip_order');
    }

    public function soDetail(){
        return $this->hasMany('App\SlipOrderDetail', 'id_slip_order','id_slip_order');
    }

}
