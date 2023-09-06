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
        Schema::create('demand_companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('overseas_agent_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->text('title');
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->text('mobile')->nullable();
            $table->text('address')->nullable();
            $table->text('fax_number')->nullable();
            $table->text('website')->nullable();
            $table->string('country')->nullable();
            $table->integer('country_state_id')->nullable()->unsigned();
            $table->enum('status', ['continued','discontinued'])->default('continued');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('country_state_id')->references('id')->on('country_states')->onUpdate('cascade')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demand_companies');
    }
};
