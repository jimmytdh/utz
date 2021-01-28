<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('admission_type');
            $table->dateTime('date_started')->nullable();
            $table->dateTime('date_ended')->nullable();
            $table->integer('patient_id');
            $table->string('room')->nullable();
            $table->string('ward')->nullable();
            $table->string('referring_doctor')->nullable();
            $table->string('scan_indication')->nullable();
            $table->string('gp_code')->nullable();
            $table->string('lmp')->nullable();
            $table->string('pmp')->nullable();
            $table->string('menstrual_age')->nullable();
            $table->string('sheet')->nullable();
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
        Schema::dropIfExists('admissions');
    }
}
