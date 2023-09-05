<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('candidate_personal_information_id')->unsigned();
            $table->string('certificate_no')->nullable();
            $table->string('institute_name')->nullable();
            $table->string('training_type')->nullable();
            $table->string('country')->nullable();
            $table->integer('duration')->nullable();
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
        Schema::dropIfExists('professional_trainings');
    }
}
