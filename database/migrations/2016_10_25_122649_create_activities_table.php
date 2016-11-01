<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('type');
            $table->string('title');
            $table->text('description');
            $table->unsignedTinyInteger('difficulty_level_start');
            $table->unsignedTinyInteger('difficulty_level_end');
            $table->unsignedSmallInteger('playing_time');
            $table->string('language');
            $table->string('contact_information');
            $table->string('featured_image')->nullable();
            $table->unsignedTinyInteger('zoo');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->index('type');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
