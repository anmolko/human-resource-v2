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
        Schema::table('demand_informations', function (Blueprint $table) {
            $table->integer('country_state_id')->after('demand_company_id')->nullable()->unsigned();
            $table->foreign('country_state_id')->references('id')->on('country_states')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('demand_informations', function (Blueprint $table) {
            $table->dropForeign(['country_state_id']);
            $table->dropColumn('country_state_id');
        });
    }
};
