<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGameAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_answers', function (Blueprint $table) {
            $table->index('correct');
            $table->index('is_answered');
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
            $table->dropIndex(['correct']);
            $table->dropIndex(['is_answered']);
        });
    }
}
