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
            $table->string('scan')->nullable();
            $table->string('cervix')->nullable();
            $table->string('uterine')->nullable();
            $table->string('endometrium')->nullable();
            $table->string('right_ovary')->nullable();
            $table->string('right_follicles')->nullable();
            $table->string('left_ovary')->nullable();
            $table->string('left_follicles')->nullable();
            $table->string('findings')->nullable();
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
        Schema::dropIfExists('sonographics');
    }
}
