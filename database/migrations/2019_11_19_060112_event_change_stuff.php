<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventChangeStuff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event', function (Blueprint $table) {
            $table->dropColumn('event_detailsAdded');
            $table->dropColumn('is_holiday');
            $table->text('event_detailsAdded')->nullable();
            $table->text('reservation_file_path')->nullable();
            $table->float('total_amount_due')->nullable();
            $table->tinyInteger('is_holiday')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event', function (Blueprint $table) {

        });
    }
}
