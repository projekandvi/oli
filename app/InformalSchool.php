<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformalSchool extends Model
{
    protected $guarded=[];

    public function user() {
    	return $this->hasOne('App\User','id','id_user');
    }
}
