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
            $table->dateTime('date_started');
            $table->dateTime('date_ended');
            $table->integer('patient_id');
            $table->string('room');
            $table->string('ward');
            $table->string('referring_doctor');
            $table->string('scan_indication');
            $table->string('gp_code');
            $table->string('lmp');
            $table->string('pmp');
            $table->string('menstrual_age');
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
