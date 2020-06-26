<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $guarded=[];

    public function so() {
    	return $this->hasMany('App\SlipOrder','nama_seller','id');
    }

    public function salesManager() {
    	return $this->hasOne('App\SalesManager','id','id_manajer');
    }
}
