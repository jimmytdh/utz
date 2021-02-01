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
            $table->string('fetus_no');
            $table->string('presentation');
            $table->string('heart_activity');
            $table->char('gender');
            $table->string('biometry');
            $table->string('bpd');
            $table->string('hc');
            $table->string('fl');
            $table->string('fac');
            $table->string('sefw');
            $table->string('others');
            $table->string('gestation_age');
            $table->string('afi');
            $table->string('single_vertical');
            $table->string('location');
            $table->string('grade');
            $table->string('abnormality');
            $table->string('cord_vessels');
            $table->integer('nst');
            $table->integer('nst2');
            $table->integer('amniotic');
            $table->integer('amniotic2');
            $table->integer('body_movement');
            $table->integer('body_movement2');
            $table->integer('fetal_tone');
            $table->integer('fetal_tone2');
            $table->integer('fetal_breathing');
            $table->integer('fetal_breathing2');
            $table->string('doppler_velocimetry');
            $table->string('other_findings');
            $table->text('remarks');
            $table->char('cerebral');
            $table->char('cranium');
            $table->char('cranifaceum');
            $table->char('spine');
            $table->char('heart');
            $table->char('stomach');
            $table->char('abnormal_wall');
            $table->char('insertion');
            $table->char('kidneys');
            $table->char('bladder');
            $table->char('upper_extremities');
            $table->char('lower_extremities');
            $table->char('atypical_finds');
            $table->string('atypical_finds_desc');
            $table->integer('ob_doctor');
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
