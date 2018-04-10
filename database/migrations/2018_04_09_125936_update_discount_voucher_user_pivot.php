<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDiscountVoucherUserPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discount_voucher_user', function (Blueprint $table) {
            $table->uuid('game_id')->nullable()->after('user_id');
            $table->foreign('game_id')
                ->references('id')
                ->on('games')
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
        Schema::table('discount_voucher_user', function (Blueprint $table) {
            $table->dropForeign('discount_voucher_user_game_id_foreign');
            $table->dropColumn('game_id');
        });
    }
}
