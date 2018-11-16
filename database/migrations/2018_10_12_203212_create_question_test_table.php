<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_test', function (Blueprint $table) {
            $table->increments('id');
            $table->string('result');
            $table->unsignedInteger('question_id')->nullable();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
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
        Schema::dropIfExists('question_test');
    }
}
