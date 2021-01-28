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
            $table->string('scan_type')->nullable();
            $table->char('gestational_sac')->nullable();
            $table->string('location')->nullable();
            $table->string('borders')->nullable();
            $table->string('mean_sac')->nullable();
            $table->string('yolk_sac')->nullable();
            $table->string('subchrionic')->nullable();
            $table->string('fetus')->nullable();
            $table->integer('number')->nullable();
            $table->char('well_formed')->nullable();
            $table->char('heart_motion')->nullable();
            $table->char('body_movement')->nullable();
            $table->string('crl')->nullable();
            $table->string('gestational_age')->nullable();
            $table->string('right_ovary')->nullable();
            $table->string('left_ovary')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('early_pregnancies');
    }
}
