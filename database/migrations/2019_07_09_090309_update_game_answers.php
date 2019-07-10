<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGameAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_answers', function (Blueprint $table) {
            $table->boolean('is_answered')->default(false)->after('correct');
            $table->dateTime('answering_start_time')->nullable()->after('is_answered');
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
            $table->dropColumn('is_answered');
            $table->dropColumn('answering_start_time');
        });
    }
}
