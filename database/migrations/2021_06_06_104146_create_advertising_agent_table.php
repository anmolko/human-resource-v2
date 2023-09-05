<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisingAgentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertising_agent', function (Blueprint $table) {
            $table->increments('id');
            $table->string('registration_no');
            $table->string('company_name');
            $table->string('address');
            $table->string('country');
            $table->string('contact');
            $table->string('email');
            $table->enum('status', ['continued','discontinued']);
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
        Schema::dropIfExists('advertising_agent');
    }
}
