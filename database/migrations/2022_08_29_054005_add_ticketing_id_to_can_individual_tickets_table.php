<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTicketingIdToCanIndividualTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('can_individual_tickets', function (Blueprint $table) {
            $table->string('booking_description')->after('airline_id')->nullable();
            $table->string('booking_date')->after('airline_id')->nullable();
            $table->string('booking_time')->after('airline_id')->nullable();
            $table->integer('ticketing_agent_id')->unsigned()->nullable()->after('airline_id');
            $table->foreign('ticketing_agent_id')->references('id')->on('ticketing_agent')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('can_individual_tickets', function (Blueprint $table) {
            $table->dropColumn('ticketing_agent_id');
            $table->dropColumn('booking_time');
            $table->dropColumn('booking_date');
            $table->dropColumn('booking_description');
        });
    }
}
