<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlaceIdColumnToReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->integer('place_id');
        });

        Schema::drop('place_review');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('place_id');
        });

        Schema::create('place_review', function (Blueprint $table) {
            $table->integer('place_id');
            $table->integer('review_id');
            $table->primary(['review_id', 'place_id']);
        });
    }
}
