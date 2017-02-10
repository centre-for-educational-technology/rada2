<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreareGameAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_answers', function (Blueprint $table) {
            $table->uuid('game_id');
            $table->unsignedInteger('activity_item_id');
            // TODO Chaneg to mediumText or MediumBlob just in case
            $table->text('answer')->nullable();
            $table->string('image')->nullable();
            $table->boolean('correct');
            $table->timestamps();

            $table->primary(['game_id', 'activity_item_id']);
            $table->foreign('game_id')
                ->references('id')
                ->on('games')
                ->onDelete('cascade');
            $table->foreign('activity_item_id')
                ->references('id')
                ->on('activity_items')
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
        Schema::dropIfExists('game_answers');
    }
}
