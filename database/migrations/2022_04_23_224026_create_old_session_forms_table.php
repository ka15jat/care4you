<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldSessionFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_session_forms', function (Blueprint $table) {
            $table->id();
            $table->string('residentID');
            $table->string('staffID');
            $table->longText('activityMorning');
            $table->longText('activityMidday');
            $table->longText('activityAfternoon');
            $table->longText('activityEvening');
            $table->string('moodMorning');
            $table->string('moodMidday');
            $table->string('moodAfternoon');
            $table->string('moodEvening');

            $table->string('breakfast');
            $table->string('lunch');
            $table->string('dinner');
            $table->string('snacks');

            #personal hygine
            $table->boolean('has_showered')->nullable();
            $table->boolean('has_changed_clothes')->nullable();
            $table->boolean('has_brushed_teeth')->nullable();
            

            #cleaning 
            $table->string('cleaning_completed_today');
            $table->string('cleaning_required');

            #handover
            $table->string('handover');
            $table->string('staff_support');

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
        Schema::dropIfExists('old_session_forms');
    }
}
