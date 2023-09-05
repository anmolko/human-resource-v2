<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatePersonalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_personal_info', function (Blueprint $table) {
            $table->id();
            $table->string('registration_no')->unique();
            $table->string('serial_no')->unique()->nullable();
            $table->date('registration_date_ad')->nullable();
            $table->date('registration_date_bs')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('issued_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->integer('reference_information_id')->unsigned();
            $table->string('receipt_no')->nullable();
            $table->string('candidate_firstname');
            $table->string('candidate_middlename')->nullable();
            $table->string('candidate_lastname');
            $table->integer('age')->nullable();
            $table->string('next_of_kin')->nullable();
            $table->string('kin_relationship')->nullable();
            $table->string('kin_contact_no')->nullable();
            $table->enum('gender', ['male','female','others'])->default('others');
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('martial_status')->nullable();
            $table->string('spouse')->nullable();
            $table->string('children')->nullable();
            $table->string('email_address')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_contact_no')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_contact_no')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('temporary_address')->nullable();
            $table->string('aboard_contact_no')->nullable();
            $table->enum('candidate_type', ['rba','non rba','default'])->default('default');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('reference_information_id')->references('id')->on('reference_informations')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('candidate_personal_info');
    }
}
