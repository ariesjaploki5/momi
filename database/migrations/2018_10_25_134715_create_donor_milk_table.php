<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonorMilkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donor_milk', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('donor_id')->nullable();
            $table->foreign('donor_id')->references('id')->on('donors')->onDelete('cascade');
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
        Schema::dropIfExists('donor_milk');
    }
}
