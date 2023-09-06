<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jobs_to_demands', function (Blueprint $table) {
            $table->string('job_status')->nullable()->change();
            $table->string('requirements')->nullable()->change();
            $table->string('min_qualification')->nullable()->change();
            $table->string('contact_period')->nullable()->change();
            $table->string('working')->nullable()->change();
            $table->string('holidays')->nullable()->change();
            $table->string('hours')->nullable()->change();
            $table->string('salary')->nullable()->change();
            $table->string('food_facilities')->nullable()->change();
            $table->string('currency')->nullable()->change();
            $table->string('accommodation')->nullable()->change();
            $table->string('ticket')->nullable()->change();
            $table->string('overtime')->nullable()->change();
            $table->string('medical_in')->nullable()->change();
            $table->string('medical_company')->nullable()->change();
            $table->string('insurance_in')->nullable()->change();
            $table->string('insurance_company')->nullable()->change();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs_to_demands', function (Blueprint $table) {
            $table->string('job_status')->nullable(false)->change();
            $table->string('requirements')->nullable(false)->change();
            $table->string('contact_period')->nullable(false)->change();
            $table->string('working')->nullable(false)->change();
            $table->string('holidays')->nullable(false)->change();
            $table->string('hours')->nullable(false)->change();
            $table->string('salary')->nullable(false)->change();
            $table->string('food_facilities')->nullable(false)->change();
            $table->string('currency')->nullable(false)->change();
            $table->string('accommodation')->nullable(false)->change();
            $table->string('ticket')->nullable(false)->change();
            $table->string('overtime')->nullable(false)->change();
            $table->string('medical_in')->nullable(false)->change();
            $table->string('medical_company')->nullable(false)->change();
            $table->string('insurance_in')->nullable(false)->change();
            $table->string('insurance_company')->nullable(false)->change();
        });
    }
};
