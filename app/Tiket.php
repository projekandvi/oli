<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tiket extends Model
{
    // use SoftDeletes;
    protected $guarded=[];
    
    public function customer() {
        return $this->hasOne('App\Customer', 'id', 'id_customer');
    }
}
