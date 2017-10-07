<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pageurls extends Model
{
	//disable updated_at column check from Eloquent
	public $timestamps = false;

	// "id" is not mention as not fillable
    protected $fillable = ['user_id','url'];
}