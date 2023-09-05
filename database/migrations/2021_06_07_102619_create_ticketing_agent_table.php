<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketingAgentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketing_agent', function (Blueprint $table) {
            $table->increments('id');
            $table->string('agent_id')->nullable();
            $table->string('company_name')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('contact')->nullable();
            $table->string('fax_no')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('postal_address')->nullable();
            $table->enum('status', ['continued','discontinued'])->nullable();
            $table->string('fullname')->nullable();
            $table->string('designation')->nullable();
            $table->string('personal_contact')->nullable();
            $table->string('personal_mobile')->nullable();
            $table->string('personal_email')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
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
        Schema::dropIfExists('ticketing_agent');
    }
}
