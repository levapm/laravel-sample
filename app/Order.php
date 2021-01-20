<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'reserve_header_id', 
        'process_code', 
        'curr_acc_code', 
        'reserve_number', 
        'reserve_date', 
        'warehouse_code', 
        'customer_name',
        'quantity',
        'total_cost'
    ];
}
