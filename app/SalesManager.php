<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesManager extends Model
{
    protected $guarded=[];

    public function so() {
    	return $this->hasMany('App\SlipOrder','team','id');
    }
}
