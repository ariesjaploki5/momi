<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreeningTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screening_test', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('result');
            $table->unsignedInteger('screening_id')->nullable();
            $table->foreign('screening_id')->references('id')->on('screenings')->onDelete('cascade');
            $table->unsignedInteger('test_id')->nullable();
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
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
        Schema::dropIfExists('screening_test');
    }
}
