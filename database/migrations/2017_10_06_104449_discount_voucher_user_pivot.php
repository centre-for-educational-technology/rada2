<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DiscountVoucherUserPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_voucher_user', function (Blueprint $table) {
            $table->uuid('discount_voucher_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->dateTime('valid_until');
            $table->boolean('spent')->default(false);

            $table->foreign('discount_voucher_id')
                ->references('id')
                ->on('discount_vouchers')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->index('valid_until');
            $table->index('spent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_voucher_user');
    }
}
