<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanMedicalReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('can_medical_report', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('candidate_personal_information_id');
            $table->string('complexion')->nullable();
            $table->string('bloodgroup')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('check_medical')->nullable();
            $table->string('medical_report_number')->nullable();
            $table->integer('health_clinic_id')->unsigned()->nullable();
            $table->date('report_issued_date')->nullable();
            $table->date('report_expiry_date')->nullable();
            $table->string('result')->nullable();
            $table->text('report')->nullable();
            $table->text('report_remarks')->nullable();
            $table->string('report_image')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('amount')->nullable();
            $table->unsignedBigInteger('sub_status_id')->nullable();
            $table->text('remarks')->nullable();
            $table->date('status_applied_date')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('candidate_personal_information_id')->references('id')->on('candidate_personal_info')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('health_clinic_id')->references('id')->on('health_clinic')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sub_status_id')->references('id')->on('sub_status')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('can_medical_report');
    }
}
