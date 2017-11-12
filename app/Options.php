<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Options extends Model
{
	// "id" is not mention as not fillable
    protected $fillable = [ 'name','value' ];

    public function getCachedOptions()
    {
    	$cache = env('APP_CACHE_OPTIONS');
    	$valv = Cache::remember('options', $cache, function ()
    	{
    		$dbOption = DB::table('options')->get();
    		$valv = [];
    		foreach ($dbOption as $op ) {
	            $valv[$op->name] = $op->value;
	        }
		    return $valv;
		});
		return $valv;
    }
}