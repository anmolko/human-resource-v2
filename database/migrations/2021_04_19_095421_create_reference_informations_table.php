<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenceInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reference_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_name')->unique();
            $table->string('optional_name')->nullable();
            $table->integer('branch_office_id')->unsigned();
            $table->string('company')->nullable();
            $table->string('country');
            $table->string('address');
            $table->string('contact_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email_address');
            $table->enum('status', ['continued','discontinued']);
            $table->string('image')->nullable();
            $table->string('name_of_organization')->nullable();
            $table->string('membership_no')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('branch_office_id')->references('id')->on('branch_offices')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('reference_informations');
    }
}
