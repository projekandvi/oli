<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class DeliveryOrder extends Model
{
    use AutoNumberTrait;
    protected $guarded=[];
    protected $primaryKey = 'id_do';
    public $incrementing = false;

    /**
     * Return the autonumber configuration array for this model.
     *
     * @return array
     */
    public function getAutoNumberOptions()
    {
        return [
            'id_do' => [
                'format' => '?', // autonumber format. '?' will be replaced with the generated number.
                'length' => 5 // The number of digits in an autonumber
            ]
        ];
    }

    public function deliveryOrderDetail() {
    	return $this->hasMany('App\DeliveryOrderDetail','id_do','id_do');
    }

    public function usernya() {
    	return $this->hasOne('App\User','id','id_staf');
    }

    public function so() {
    	return $this->hasOne('App\SlipOrder','id_slip_order','id_slip_order');
    }

    
}
