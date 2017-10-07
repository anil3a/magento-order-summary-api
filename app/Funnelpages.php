<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funnelpages extends Model
{
	// "id" is not mention as not fillable
    protected $fillable = ['title','url','active'];
}