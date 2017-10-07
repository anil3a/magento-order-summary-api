<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pageurls extends Model
{
	// "id" is not mention as not fillable
    protected $fillable = ['user_id','url'];
}