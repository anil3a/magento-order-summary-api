<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
	// "id" is not mention as not fillable
    protected $fillable = [
    						'quote_id','order_id','page_id', 'grand_total', 
    						'email', 'delivery_type', 'delivery_date', 
    						'delivery_address', 'quantity'
    ];
}