<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sparepart extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_sparepart';
    public $incrementing = false;

    protected $guarded=[];
}
