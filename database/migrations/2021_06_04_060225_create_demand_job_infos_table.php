<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandJobInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand_job_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('candidate_personal_information_id');
            $table->unsignedBigInteger('job_category_id');
            $table->unsignedBigInteger('demand_info_id')->nullable();
            $table->unsignedBigInteger('job_to_demand_id')->nullable();
            $table->unsignedBigInteger('overseas_agent_id')->nullable();
            $table->text('skills')->nullable();
            $table->string('salary');
            $table->date('issued_date')->nullable();
            $table->date('status_applied_date')->nullable();
            $table->integer('num_of_pax')->nullable();
            $table->unsignedBigInteger('sub_status_id')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('candidate_personal_information_id')->references('id')->on('candidate_personal_info')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('job_category_id')->references('id')->on('job_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('demand_info_id')->references('id')->on('demand_informations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('job_to_demand_id')->references('id')->on('jobs_to_demands')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('overseas_agent_id')->references('id')->on('overseas_agents')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sub_status_id')->references('id')->on('sub_status')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('demand_job_infos');
    }
}
