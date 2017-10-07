<?php

use Illuminate\Database\Seeder;

class FunnelpagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Default Data for Funnel Seeders
        DB::table('funnelpages')->insert([
        	[
	            'id' => 10,
	            'title' => 'Other Pages',
	            'url' => null,
	            'active' => 1,
        	],
        	[
	            'id' => 20,
	            'title' => 'Shopping Cart',
	            'url' => null,
	            'active' => 1,
        	],
        	[
	            'id' => 30,
	            'title' => 'Delivery type',
	            'url' => null,
	            'active' => 1,
        	],
        	[
	            'id' => 40,
	            'title' => 'Delivery Date',
	            'url' => null,
	            'active' => 1,
        	],
        	[
	            'id' => 50,
	            'title' => 'Recipients',
	            'url' => null,
	            'active' => 1,
        	],
        	[
	            'id' => 60,
	            'title' => 'Billings',
	            'url' => null,
	            'active' => 1,
        	],
        	[
	            'id' => 70,
	            'title' => 'Success',
	            'url' => null,
	            'active' => 1,
        	]
    	]);
    }
}
