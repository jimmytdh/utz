<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrimestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trimesters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admission_id');
            $table->string('fetus_no')->nullable();
            $table->string('presentation')->nullable();
            $table->string('heart_activity')->nullable();
            $table->char('gender')->nullable();
            $table->string('biometry')->nullable();
            $table->string('bpd')->nullable();
            $table->string('hc')->nullable();
            $table->string('fl')->nullable();
            $table->string('fac')->nullable();
            $table->string('sefw')->nullable();
            $table->string('others')->nullable();
            $table->string('gestation_age')->nullable();
            $table->string('afi')->nullable();
            $table->string('single_vertical')->nullable();
            $table->string('location')->nullable();
            $table->string('grade')->nullable();
            $table->string('abnormality')->nullable();
            $table->string('cord_vessels')->nullable();
            $table->integer('nst')->nullable();
            $table->integer('amniotic')->nullable();
            $table->integer('body_movement')->nullable();
            $table->integer('fetal_tone')->nullable();
            $table->integer('fetal_breathing')->nullable();
            $table->string('doppler_velocimetry')->nullable();
            $table->string('other_findings')->nullable();
            $table->text('remarks')->nullable();
            $table->char('cerebral')->nullable();
            $table->char('cranium')->nullable();
            $table->char('face')->nullable();
            $table->char('spine')->nullable();
            $table->char('heart')->nullable();
            $table->char('stomach')->nullable();
            $table->char('abnormal_wall')->nullable();
            $table->char('insertion')->nullable();
            $table->char('kidneys')->nullable();
            $table->char('bladder')->nullable();
            $table->char('upper_extremities')->nullable();
            $table->char('lower_extremities')->nullable();
            $table->char('atypical_finds')->nullable();
            $table->string('atypical_finds_desc')->nullable();
            $table->integer('ob_doctor')->nullable();
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
        Schema::dropIfExists('trimesters');
    }
}
