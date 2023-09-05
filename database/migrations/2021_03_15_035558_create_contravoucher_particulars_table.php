<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContravoucherParticularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contravoucher_particulars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('contra_voucher_id')->nullable();
            $table->unsignedBigInteger('by_debit_id')->nullable();
            $table->unsignedBigInteger('to_credit_id')->nullable();
            $table->unsignedBigInteger('initial_acc_id')->nullable();
            $table->boolean('status')->default(1);
            $table->decimal('debit_amount',8,2)->nullable();
            $table->decimal('credit_amount',8,2)->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('by_debit_id')->references('id')->on('secondary_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('to_credit_id')->references('id')->on('secondary_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('initial_acc_id')->references('id')->on('secondary_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('contra_voucher_id')->references('id')->on('contra_vouchers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('contravoucher_particulars');
    }
}
