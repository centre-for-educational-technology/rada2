<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMissingIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->index('title');
            $table->index('difficulty_level');
            $table->index('language');
            $table->index('zoo');
            $table->index('created_at');
            $table->index('updated_at');
            $table->index('deleted_at');
        });
        Schema::table('activity_items', function (Blueprint $table) {
            $table->index('title');
            $table->index('created_at');
            $table->index('updated_at');
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
            $table->dropIndex(['title']);
            $table->dropIndex(['difficulty_level']);
            $table->dropIndex(['language']);
            $table->dropIndex(['zoo']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['updated_at']);
            $table->dropIndex(['deleted_at']);
        });
        Schema::table('activity_items', function (Blueprint $table) {
            $table->dropIndex(['title']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['updated_at']);
        });
    }
}
