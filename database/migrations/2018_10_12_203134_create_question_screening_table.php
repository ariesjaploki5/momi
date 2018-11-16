<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionScreeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_screening', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('answer');
            $table->unsignedInteger('question_id')->nullable();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->unsignedInteger('screening_id')->nullable();
            $table->foreign('screening_id')->references('id')->on('screenings')->onDelete('cascade');
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
        Schema::dropIfExists('question_screening');
    }
}
