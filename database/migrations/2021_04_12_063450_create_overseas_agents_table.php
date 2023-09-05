<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverseasAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overseas_agents', function (Blueprint $table) {
            $table->id();
            $table->string('client_no')->unique();
            $table->enum('type_of_company', ['company','individual']);
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('country')->nullable();
            $table->integer('country_state_id')->unsigned();
            $table->string('company_contact_num')->nullable();
            $table->string('fax_num')->nullable();
            $table->string('company_email');
            $table->string('website')->nullable();
            $table->string('postal_address')->nullable();
            $table->enum('status', ['continued','discontinued'])->default('continued');
            $table->string('fullname')->nullable();
            $table->string('designation')->nullable();
            $table->string('personal_email')->nullable();
            $table->string('personal_mobile')->nullable();
            $table->string('personal_contact_num')->nullable();
            $table->string('image')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('country_state_id')->references('id')->on('country_states')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('overseas_agents');
    }
}
