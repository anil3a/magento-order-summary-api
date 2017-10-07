<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Default Data for Funnel Seeders
        DB::table('users')->insert(
        	[
	            'quote_id' => 1,
	            'order_id' => null,
	            'page_id' => 10,
	            'grand_total' => null,
	            'email' => null,
	            'delivery_type' => null,
	            'delivery_date' => null,
	            'delivery_address' => null,
	            'quantity' => 0
        	]
    	);
    }
}