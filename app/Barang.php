<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_barang';
    public $incrementing = false;
    // protected $table = 'barangs';

    protected $guarded=[];

    public function sparepart() {
    	return $this->hasMany('App\Sparepart','id_barang','id_barang');
    }

    public function lokasiGudang() {
    	return $this->hasMany('App\LokasiBarang','id_barang','id_barang');
    }
    public function invoice()
    {
        return $this->hasOne('App\Invoice', 'id_barang');
    }

    public function lokstok()
    {
        return $this->hasOne('App\LokasiStok', 'id','id_lokasi_stok');
    }
    
}
