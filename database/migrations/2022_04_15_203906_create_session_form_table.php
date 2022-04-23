<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_form', function (Blueprint $table) {
            $table->id()->nullable();
            $table->string('residentID')->nullable();
            $table->string('staffID')->nullable();
            $table->longText('activityMorning')->nullable();
            $table->longText('activityMidday')->nullable();
            $table->longText('activityAfternoon')->nullable();
            $table->longText('activityEvening')->nullable();
            #mood should be updated every 6 hours
            $table->string('moodMorning')->nullable();
            $table->string('moodMidday')->nullable();
            $table->string('moodAfternoon')->nullable();
            $table->string('moodEvening')->nullable();

            $table->string('breakfast')->nullable();
            $table->string('lunch')->nullable();
            $table->string('dinner')->nullable();
            $table->string('snacks')->nullable();

            #personal hygine
            $table->boolean('has_showered')->nullable()->nullable();
            $table->boolean('has_changed_clothes')->nullable();
            $table->boolean('has_brushed_teeth')->nullable();
            

            #cleaning 
            $table->string('cleaning_completed_today')->nullable();
            $table->string('cleaning_required')->nullable();

            #handover
            $table->string('handover')->nullable();
            $table->string('staff_support')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_form');
    }
}
