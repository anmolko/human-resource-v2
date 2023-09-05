<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('candidate_personal_information_id')->unsigned();
            $table->enum('resume', ['yes','no']);
            $table->enum('original_passport', ['yes','no']);
            $table->enum('passport_xerox_copy', ['yes','no']);
            $table->enum('academic_certificates', ['yes','no']);
            $table->enum('professional_training', ['yes','no']);
            $table->enum('work_certificates', ['yes','no']);
            $table->enum('medical_reports', ['yes','no']);
            $table->enum('original_driving_license', ['yes','no']);
            $table->enum('driving_license_copy', ['yes','no']);
            $table->enum('photographs', ['yes','no']);
            $table->string('photograph_image')->nullable();
            $table->string('passport_image')->nullable();
            $table->string('signature_image')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('candidate_personal_information_id')->references('id')->on('candidate_personal_info')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('document_infos');
    }
}
