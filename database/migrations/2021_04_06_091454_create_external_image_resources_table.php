<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateExternalImageResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_image_resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('provider');
            $table->string('image_url', 2048);
            $table->json('external_data');
            $table->timestamps();

            $table->index('provider');
            $table->index('created_at');
            $table->index('updated_at');
        });

        DB::statement('ALTER TABLE external_image_resources ADD FULLTEXT (title, description)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('external_image_resources');
    }
}
