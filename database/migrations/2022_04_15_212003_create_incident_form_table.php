<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_form', function (Blueprint $table) {
            $table->id();
            $table->string('residentID');
            $table->string('StaffID');
            $table->longText('incident');
            $table->longText('outcome');
            $table->boolean('is_staff_injured')->nullable();
            $table->boolean('is_resident_injured')->nullable();
            $table->longText('injury_details')->nullable();
            $table->string('behaviour');
            $table->string('escalation')->nullable();
            $table->string('call_details')->nullable();
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
        Schema::dropIfExists('incident_form');
    }
}
