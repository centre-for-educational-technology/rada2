<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMissingPrimaryKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('social_accounts', 'tmp_social_accounts');
        Schema::table('tmp_social_accounts', function (Blueprint $table) {
            $table->dropForeign('social_accounts_user_id_foreign');
        });

        Schema::create('social_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('provider_user_id');
            $table->string('provider');
            $table->timestamps();

            $table->unique(['provider', 'provider_user_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        if ( DB::table('tmp_social_accounts')->count() > 0 )
        {
            foreach ( DB::table('tmp_social_accounts')->cursor() as $single )
            {
                DB::table('social_accounts')->insert([
                    'user_id' => $single->user_id,
                    'provider_user_id' => $single->provider_user_id,
                    'provider' => $single->provider,
                    'created_at' => $single->created_at,
                    'updated_at' => $single->updated_at,
                ]);
            }
        }
        Schema::dropIfExists('tmp_social_accounts');

        Schema::disableForeignKeyConstraints();
        Schema::table('game_answers', function (Blueprint $table)
        {
            $table->dropForeign(['game_id']);
            $table->dropForeign(['activity_item_id']);
            $table->dropPrimary();
        });
        Schema::table('game_answers', function (Blueprint $table)
        {
            $table->increments('id')->first();
            $table->unique(['game_id', 'activity_item_id']);
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
        Schema::table('social_accounts', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        Schema::table('game_answers', function (Blueprint $table)
        {
            $table->dropForeign(['game_id']);
            $table->dropForeign(['activity_item_id']);
            $table->dropColumn('id');
            $table->dropUnique(['game_id', 'activity_item_id']);
        });
        Schema::table('game_answers', function (Blueprint $table) {
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
}
