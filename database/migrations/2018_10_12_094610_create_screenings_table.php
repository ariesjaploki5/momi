<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreeningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screenings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('child_firstname');
            $table->string('child_lastname');
            $table->date('birthdate');
            $table->string('gender');
            $table->text('reason_why')->nullable();

            $table->datetime('start_time')->nullable();
            $table->datetime('finish_time')->nullable();

            $table->boolean('approved_for_medical_test')->default(0);
            $table->boolean('medical_test')->default(0);
            $table->boolean('approved_to_donate')->default(0);

            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->unsignedInteger('candidate_id')->nullable();
            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
            $table->unsignedInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->unsignedInteger('nurse_id')->nullable();
            $table->foreign('nurse_id')->references('id')->on('nurses')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('screenings');
    }
}
