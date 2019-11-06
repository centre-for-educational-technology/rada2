<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAnsweringEndTimeToGameAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_answers', function (Blueprint $table) {
            $table->dateTime('answering_end_time')->nullable()->after('answering_start_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_answers', function (Blueprint $table) {
            $table->dropColumn('answering_end_time');
        });
    }
}
