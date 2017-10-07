<?php

use Illuminate\Database\Seeder;

class PageurlsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Default Data for Pageurls Seeders
        DB::table('pageurls')->insert([
	            'user_id' => '1',
	            'url' => 'https://sparklecupcakery/checkout/cart',
    	]);
    }
}
