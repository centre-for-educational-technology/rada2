<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateActivitySwedishLanguageCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( DB::table('activities')->where('language', 'swe')->count() > 0 )
        {
            DB::table('activities')
                ->where('language', 'swe')
                ->update(['language' => 'sv']);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // This is a fix, nothing to reverse
    }
}
