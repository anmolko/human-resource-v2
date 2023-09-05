<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplainManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complain_manager', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('candidate_info_id');
            $table->string('passport_num');
            $table->string('job_category')->nullable();
            $table->string('company');
            $table->string('contact_person');
            $table->string('regd_by')->nullable();
            $table->integer('employee_id')->unsigned();
            $table->string('type');
            $table->integer('priority')->default(1);
            $table->text('subject');
            $table->text('message');
            $table->date('regd_date');
            $table->string('status');
            $table->date('solved_date')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('candidate_info_id')->references('id')->on('candidate_personal_info')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('complain_manager');
    }
}
