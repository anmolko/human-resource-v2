<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payroll_id')->unsigned();
            $table->string('basic_salary')->nullable();
            $table->string('gross_salary')->nullable();
            $table->string('total_deduction')->nullable();
            $table->string('net_salary')->nullable();
            $table->string('provident_fund')->nullable();
            $table->string('payment_amount');
            $table->string('payment_month');
            $table->unsignedBigInteger('secondary_group_id')->comment('This is payment type. Variation of cash and bank from secondary group');
            $table->text('note');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payroll_id')->references('id')->on('payrolls')->onUpdate('cascade');
            $table->foreign('secondary_group_id')->references('id')->on('secondary_groups')->onUpdate('cascade');
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
        Schema::dropIfExists('salary_payment');
    }
}
