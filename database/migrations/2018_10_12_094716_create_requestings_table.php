<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('child_firstname');
            $table->string('child_lastname');
            $table->date('birthdate');
            $table->string('gender');
            $table->text('reason_why')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->datetime('schedule')->nullable();
            $table->boolean('approved')->default(0);


            $table->unsignedInteger('doctor_id')->nullable();
            $table->unsignedInteger('nurse_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
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
        Schema::dropIfExists('requestings');
    }
}
