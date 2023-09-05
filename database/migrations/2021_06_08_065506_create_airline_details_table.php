<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirlineDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airline_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_no');
            $table->string('country')->nullable();
            $table->integer('country_state_id')->unsigned()->nullable();
            $table->string('country_one')->nullable();
            $table->string('country_two')->nullable();
            $table->string('country_three')->nullable();
            $table->string('transaction')->nullable();
            $table->string('total_cost')->nullable();
            $table->longText('remarks')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('country_state_id')->references('id')->on('country_states')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('airline_details');
    }
}
