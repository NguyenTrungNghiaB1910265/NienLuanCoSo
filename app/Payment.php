<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'payment_method', 
        'branpayment_status'
    ];
    protected $primaryKey = 'payment_id';
    protected $table = 'tbl_payment';
}
