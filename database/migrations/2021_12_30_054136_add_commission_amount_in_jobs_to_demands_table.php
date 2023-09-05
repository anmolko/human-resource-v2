<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommissionAmountInJobsToDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs_to_demands', function (Blueprint $table) {
            $table->string('category_amount')->after('salary')->nullable();
            $table->string('commission_amount')->after('salary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs_to_demands', function (Blueprint $table) {
            $table->dropColumn('category_amount');
            $table->dropColumn('commission_amount');
        });
    }
}
