<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->string('type')->default('priority');
            $table->date('received_at')->nullable();
            $table->unsignedInteger('requesting_id')->nullable();
            $table->foreign('requesting_id')->references('id')->on('requestings')->onDelete('cascade');
            $table->unsignedInteger('milk_id')->nullable();
            $table->foreign('milk_id')->references('id')->on('milks')->onDelete('cascade');
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
        Schema::dropIfExists('containers');
    }
}
