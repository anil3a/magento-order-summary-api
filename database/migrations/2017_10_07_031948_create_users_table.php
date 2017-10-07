<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quote_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('page_id')->default('10');
            $table->string('grand_total', 10)->nullable();
            $table->string('email', 60)->nullable();
            $table->string('delivery_type', 50)->nullable();
            $table->string('delivery_date', 23)->nullable();
            $table->string('delivery_address', 500)->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
