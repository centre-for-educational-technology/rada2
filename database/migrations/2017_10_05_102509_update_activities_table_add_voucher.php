<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateActivitiesTableAddVoucher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->uuid('discount_voucher_id')->nullable()->after('user_id');
            $table->foreign('discount_voucher_id')
                ->references('id')
                ->on('discount_vouchers')
                ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropForeign('activities_discount_voucher_id_foreign');
            $table->dropColumn('discount_voucher_id');
        });
    }
}
