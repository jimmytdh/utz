<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSonographicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sonographics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admission_id');
            $table->string('scan');
            $table->string('cervix');
            $table->string('uterine');
            $table->string('endometrium');
            $table->string('right_ovary');
            $table->string('right_follicles');
            $table->string('left_ovary');
            $table->string('left_follicles');
            $table->string('findings');
            $table->string('findings');
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
        Schema::dropIfExists('sonographics');
    }
}
