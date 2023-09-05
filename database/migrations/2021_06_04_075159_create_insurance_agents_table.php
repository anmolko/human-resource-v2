<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_agents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name')->unique();
            $table->string('company_address');
            $table->string('country');
            $table->string('company_contact_num');
            $table->string('company_email');
            $table->enum('status', ['continued','discontinued']);
            $table->string('personal_fullname')->nullable();
            $table->string('personal_designation')->nullable();
            $table->string('personal_contact_num')->nullable();
            $table->string('personal_mobile_num')->nullable();
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
        Schema::dropIfExists('insurance_agents');
    }
}
