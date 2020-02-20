<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSupplierTable extends Migration
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
            if (Schema::hasColumn('supplier', 'landline')) {
                $table->dropColumn('landline');
            }
            if (Schema::hasColumn('supplier', 'fax')) {
                $table->dropColumn('fax');
            }
            if (Schema::hasColumn('supplier', 'mobile')) {
                $table->dropColumn('mobile');
            }
            if (Schema::hasColumn('supplier', 'payment_terms')) {
                $table->dropColumn('payment_terms');
            }
            if (Schema::hasColumn('supplier', 'company_address')) {
                $table->dropColumn('company_address');
            }
            if (Schema::hasColumn('supplier', 'billing_address')) {
                $table->dropColumn('billing_address');
            }
            if (Schema::hasColumn('supplier', 'supplier_type')) {
                $table->dropColumn('supplier_type');
            }
            if (Schema::hasColumn('supplier', 'remarks')) {
                $table->dropColumn('remarks');
            }
            
            if (Schema::hasColumn('supplier', 'created_at')) {
                $table->dropColumn('created_at');
            }
            if (Schema::hasColumn('supplier', 'updated_at')) {
                $table->dropColumn('updated_at');
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
