<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resident', function (Blueprint $table) {
            $table->id();
            $table->string('companyCode');         
            $table->string('firstname');
            $table->string('lastname');
            $table->date('dob');
            $table->string('doctor');
            $table->string('doctor_address');
            $table->longText('care_plan');
            $table->longText('mental_health_history');
            $table->longText('physical_health_history');
            $table->string('address');
            $table->string('path');
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
        Schema::dropIfExists('resident');
    }
}
