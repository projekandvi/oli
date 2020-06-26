<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Sementara extends Model
{
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
            'nomor_otomatis' => [
                'format' => '?', // autonumber format. '?' will be replaced with the generated number.
                'length' => 5 // The number of digits in an autonumber
            ]
        ];
    }
}
