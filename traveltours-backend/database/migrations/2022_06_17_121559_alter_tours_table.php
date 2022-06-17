<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('tours');
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('dest');
            $table->integer('tour_guide_id');
            $table->integer('price_id');
            $table->integer('range');
            $table->timestamp('start_date');
            $table->string('vehicle');
            $table->integer('hotel_star');
            $table->text('schedule');
            $table->string('places');
            $table->integer('max_slot');
            $table->integer('slot')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
