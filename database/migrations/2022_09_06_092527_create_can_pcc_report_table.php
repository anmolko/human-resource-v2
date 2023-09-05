<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanPccReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('can_pcc_report', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('candidate_personal_information_id');
            $table->string('country')->nullable();
            $table->date('issued')->nullable();
            $table->date('stamping_date')->nullable();
            $table->string('registration_number')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('can_pcc_report');
    }
}
