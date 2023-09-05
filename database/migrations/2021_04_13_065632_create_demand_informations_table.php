<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand_informations', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no')->unique();
            $table->string('serial_no')->unique();
            $table->string('company_name');
            $table->unsignedBigInteger('overseas_agent_id');
            $table->string('country');
            $table->integer('country_state_id')->unsigned();
            $table->string('address');
            $table->string('telephone');
            $table->string('fax_no');
            $table->string('website');
            $table->string('email');
            $table->string('category');
            $table->date('fulfill_date');
            $table->date('issued_date');
            $table->date('expired_date');
            $table->string('advertised');
            $table->string('status');
            $table->string('doc_status');
            $table->integer('num_of_pax');
            $table->date('doc_received_date');
            $table->string('doc_status_remarks');
            $table->string('image')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('overseas_agent_id')->references('id')->on('overseas_agents')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('country_state_id')->references('id')->on('country_states')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('demand_informations');
    }
}
