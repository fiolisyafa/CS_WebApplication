<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_activities', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->mediumText('description');
            $table->integer('fee');
            $table->dateTime('date_time');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('itinerary_id');
            $table->unsignedBigInteger('activity_type_id');

            $table->timestamps();

            // Keys
            $table->primary('id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('itinerary_id')->references('id')->on('itineraries');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('activity_type_id')->references('id')->on('activity_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_activities');
    }
}
