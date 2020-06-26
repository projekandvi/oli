<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Alfa6661\AutoNumber\AutoNumberTrait;

class SlipOrder extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;
    protected $primaryKey = 'id_slip_order';
    public $incrementing = false;

    protected $guarded=[];

    /**
     * Return the autonumber configuration array for this model.
     *
     * @return array
     */
    public function getAutoNumberOptions()
    {
        return [
            'id_slip_order' => [
                'format' => '?', // autonumber format. '?' will be replaced with the generated number.
                'length' => 5 // The number of digits in an autonumber
            ]
        ];
    }

    public function barang() {
    	return $this->hasOne('App\Barang','id_barang','id_barang');
    }

    public function customer() {
    	return $this->hasOne('App\Customer','id','id_customer');
    }

    public function salesManagernya() {
    	return $this->hasOne('App\SalesManager','id','team');
    }

    public function salesnya() {
    	return $this->hasOne('App\Sales','id','nama_seller');
    }

    public function instalasi() {
    	return $this->hasOne('App\Instalasi','id_slip_order','id_slip_order');
    }

    public function pembayar() {
    	return $this->hasMany('App\Pembayaran','id_slip_order','id_slip_order');
    }

    public function fault() {
    	return $this->hasMany('App\FaultRecurringHistory','id_slip_order','id_slip_order');
    }

    public function slipOrderDetail() {
    	return $this->hasMany('App\SlipOrderDetail','id_slip_order','referensi_invoice');
    }

    public function bank()
    {
        return $this->hasOne('App\MasterBank', 'kode_bank','jenis_bank_recurring');
    }

    public function bayarDP()
    {
        return $this->hasMany('App\Pembayaran', 'id_slip_order','id_slip_order');
    }

    public function service1() {
    	return $this->hasOne('App\Maintenance','id_slip_order','id_slip_order');
    }



    protected $casts = [
        'jenis_bank2' => 'array',
        'nominal_pembayaran2' => 'array',
    ];
}
