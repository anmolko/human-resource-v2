<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateVisaInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_visa_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('candidate_personal_information_id');
            $table->string('visa_number');
            $table->string('visa_ref_number')->nullable();
            $table->unsignedBigInteger('demand_info_id');
            $table->unsignedBigInteger('job_to_demand_id');
            $table->enum('visa_type',['single_entry','multiple_entry'])->default('single_entry')->nullable();
            $table->text('purpose')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('residency_duration')->nullable();
            $table->text('remarks')->nullable();
            $table->string('image')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('candidate_personal_information_id')->references('id')->on('candidate_personal_info')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('demand_info_id')->references('id')->on('demand_informations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('job_to_demand_id')->references('id')->on('jobs_to_demands')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('candidate_visa_info');
    }
}
