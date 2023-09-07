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
//            $table->dropForeign('demand_informations_overseas_agent_id_foreign');
//            $table->dropColumn('overseas_agent_id');
//            $table->dropForeign(['country_state_id']);
//            $table->dropColumn('country_state_id');
//            $table->dropColumn('company_name');
//            $table->dropColumn('country');
//            $table->dropColumn('address');
//            $table->dropColumn('telephone');
//            $table->dropColumn('fax_no');
//            $table->dropColumn('website');
//            $table->dropColumn('email');
            $table->foreignId('demand_company_id')->nullable()->after('serial_no')->constrained()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('demand_informations', function (Blueprint $table) {
            $table->dropForeign(['demand_company_id']);
            $table->dropColumn('demand_company_id');
//            $table->string('company_name')->nullable();
//            $table->unsignedBigInteger('overseas_agent_id')->nullable();
//            $table->string('country')->nullable();
//            $table->integer('country_state_id')->unsigned()->nullable();
//            $table->string('address')->nullable();
//            $table->string('telephone')->nullable();
//            $table->string('fax_no')->nullable();
//            $table->string('website')->nullable();
//            $table->string('email')->nullable();
//            $table->foreign('overseas_agent_id')->references('id')->on('overseas_agents')->onUpdate('cascade')->onDelete('cascade');
//            $table->foreign('country_state_id')->references('id')->on('country_states')->onUpdate('cascade')->onDelete('cascade');
        });
    }
};
