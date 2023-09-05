<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned()->unique();
            $table->string('employee_type');
            $table->string('basic_salary');
            $table->string('house_rent_allowance')->nullable();
            $table->string('medical_allowance')->nullable();
            $table->string('special_allowance')->nullable();
            $table->string('provident_fund_contribution')->nullable();
            $table->string('other_allowance')->nullable();
            $table->string('tax_deduction')->nullable();
            $table->string('provident_fund_deduction')->nullable();
            $table->string('other_deduction')->nullable();
            $table->string('total_provident_fund')->nullable();
            $table->string('net_salary')->nullable();
            $table->string('gross_salary')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('payrolls');
    }
}
