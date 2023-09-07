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
        Schema::create('company_country_states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demand_company_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->integer('country_state_id')->nullable()->unsigned();
            $table->foreign('country_state_id')->references('id')->on('country_states')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_country_states');
    }
};
