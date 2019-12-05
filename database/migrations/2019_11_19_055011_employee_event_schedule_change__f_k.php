<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeEventScheduleChangeFK extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_event_schedule', function (Blueprint $table) {
            //create here
            // $table->dropForeign(['fk_employee']);
            // $table->foreign('employee_id')

                // ->references('employee_id')
                // ->on('employee')
                // ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_event_schedule', function (Blueprint $table) {
            //drop stuff here
        });
    }
}
