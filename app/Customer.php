<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    // use SoftDeletes;
    protected $guarded=[];

    public function so()
    {
        return $this->hasMany('App\SlipOrder', 'id_customer','id');
    }
}
