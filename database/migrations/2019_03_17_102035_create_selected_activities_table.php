<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectedActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selected_activities', function (Blueprint $table) {
            $table->uuid('id');
            $table->dateTime('date_time');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('itinerary_id');
            $table->unsignedBigInteger('activity_id');
            $table->timestamps();

            // Keys
            $table->primary('id');
            $table->foreign('itinerary_id')->references('id')->on('itineraries');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('activity_id')->references('id')->on('suggested_activities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selected_activities');
    }
}
