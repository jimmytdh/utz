<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEarlyPregnanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('early_pregnancies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admission_id');
            $table->string('scan_type');
            $table->char('gestational_sac');
            $table->string('location');
            $table->string('borders');
            $table->string('mean_sac');
            $table->string('yolk_sac');
            $table->string('subchrionic');
            $table->string('fetus');
            $table->integer('number');
            $table->char('well_formed');
            $table->char('heart_motion');
            $table->char('body_movement');
            $table->string('crl');
            $table->string('gestational_age');
            $table->string('right_ovary');
            $table->string('left_ovary');
            $table->text('remarks');
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
        Schema::dropIfExists('early_pregnancies');
    }
}
