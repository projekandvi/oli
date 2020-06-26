<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportSO extends Model
{
    protected $primaryKey = 'id_slip_order';
    protected $guarded=[];
    protected $table = 'slip_orders';
}
