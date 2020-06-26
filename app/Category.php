<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    
    public function subcategories(){
    	return $this->hasMany('App\Subcategory');
    }

    public function destinations () {
    	return $this->hasManyThrough('App\Destination', 'App\Subcategory');
    }

    public function destination () {
    	return $this->hasMany('App\Destination');
    }
}
