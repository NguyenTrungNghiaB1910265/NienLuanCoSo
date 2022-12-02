<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'order_id', 
        'product_id', 
        'product_name',
        'product_price',
        'product_sales_quantity'
    ];
    protected $primaryKey = 'order_details_id';
    protected $table = 'tbl_order_details';
}
