<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInterviewDateToDemandJobInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demand_job_infos', function (Blueprint $table) {
            $table->date('interview_date')->after('status_applied_date')->nullable();
            $table->text('interview_remarks')->after('status_applied_date')->nullable();
            $table->string('receivable_salary')->after('salary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demand_job_infos', function (Blueprint $table) {
            $table->dropColumn('interview_date');
            $table->dropColumn('interview_remarks');
            $table->dropColumn('receivable_salary');
        });
    }
}
