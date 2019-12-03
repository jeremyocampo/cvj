<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManpowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manpowers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id');
            $table->string('employee_fn');
            $table->string('employee_ln');
            $table->string('employee_type');
            $table->string('email');
            $table->string('agency_id');
            $table->string('contact_no');
            $table->string('address');
            $table->string('schedule_id');
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
        Schema::dropIfExists('manpowers');
    }
}
