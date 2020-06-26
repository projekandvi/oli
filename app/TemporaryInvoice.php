<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemporaryInvoice extends Model
{
    protected $primaryKey = 'id_invoice';
    protected $guarded=[];
    public $incrementing = false;
}
