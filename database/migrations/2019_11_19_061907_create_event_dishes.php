<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventDishes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('event_dishes', function (Blueprint $table) {
        //         $table->increments('edishes_id');
        //         $table->integer('event_id')->unsigned();
        //         $table->integer('item_id')->unsigned();
        //         $table->float('total_price');
        //         $table->tinyInteger('is_addition')->nullable();
        //         $table->foreign('event_id')->references('event_id')->on('event');
        //         $table->foreign('item_id')->references('item_id')->on('items');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('event_dishes', function (Blueprint $table) {
        //     //
        // });
    }
}
