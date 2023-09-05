<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirlineDetailTicketingAgentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airline_detail_ticketing_agent', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('airline_detail_id')->unsigned();
            $table->integer('ticketing_agent_id')->unsigned();
            $table->foreign('airline_detail_id')->references('id')->on('airline_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ticketing_agent_id')->references('id')->on('ticketing_agent')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('airline_detail_ticketing_agent');
    }
}
