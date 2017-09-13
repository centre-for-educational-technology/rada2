<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeActivityDifficultyLevel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('difficulty_level_start');
            $table->dropColumn('difficulty_level_end');
            $table->unsignedTinyInteger('difficulty_level')->default(2)->after('description');
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
            $table->dropColumn('difficulty_level');
            $table->unsignedTinyInteger('difficulty_level_start')->after('description');
            $table->unsignedTinyInteger('difficulty_level_end')->after('difficulty_level_start');
        });
    }
}
