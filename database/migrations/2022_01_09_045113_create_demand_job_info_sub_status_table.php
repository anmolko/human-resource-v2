<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandJobInfoSubStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_sub_status_history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->nullable();
            $table->unsignedBigInteger('sub_status_id');
            $table->integer('candidate_personal_information_id')->nullable();
            $table->date('status_applied_date')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('candidate_sub_status_history');
    }
}
