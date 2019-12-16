<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier', function (Blueprint $table) {
            if (Schema::hasColumn('supplier','name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('supplier','email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('supplier','address')) {
                $table->dropColumn('address');
            }
            if (Schema::hasColumn('supplier','contactMobNo')) {
                $table->dropColumn('contactMobNo');
            }
            if (Schema::hasColumn('supplier','officeTelNo')) {
                $table->dropColumn('officeTelNo');
            }
        });

        Schema::table('supplier', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('landline')->nullable();
            $table->string('fax')->nullable();
            $table->string('mobile')->nullable();
            $table->string('payment_terms');
            $table->string('company_address');
            $table->string('billing_address');
            $table->enum('supplier_type', [
                'inventory',
                'equipment',
                'service'
            ]);
            $table->longText('remarks');
            $table->timestamps();
        });

        Schema::create('contact_person', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('landline');
            $table->string('fax')->nullable();
            $table->string('mobile');
            $table->boolean('is_primary')->default(false);
            $table->integer('supplier_id')->unsigned();
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
        Schema::dropIfExists('contact_person');
    }
}
