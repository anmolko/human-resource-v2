<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsToDemandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_to_demands', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_category_id');
            $table->unsignedBigInteger('demand_information_id');
            $table->string('job_status')->default('incomplete');
            $table->string('requirements');
            $table->string('min_qualification');
            $table->string('contact_period');
            $table->string('working');
            $table->string('holidays')->nullable();
            $table->string('hours');
            $table->string('salary');
            $table->string('overtime_per_month')->nullable()->default(0);
            $table->string('currency');
            $table->string('accommodation');
            $table->string('food_facilities');
            $table->string('ticket');
            $table->string('overtime')->default('no');
            $table->string('medical_in');
            $table->string('medical_company');
            $table->string('insurance_in');
            $table->string('insurance_company');
            $table->string('remarks')->nullable();
            $table->string('levy')->nullable()->default('no');
            $table->string('levy_amount')->nullable()->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('job_category_id')->references('id')->on('job_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('demand_information_id')->references('id')->on('demand_informations')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs_to_demands');
    }
}
