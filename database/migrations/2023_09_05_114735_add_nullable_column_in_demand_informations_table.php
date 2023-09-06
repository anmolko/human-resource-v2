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
            $table->unsignedBigInteger('overseas_agent_id')->nullable()->change();
            $table->string('country')->nullable()->change();
            $table->integer('country_state_id')->nullable()->change();
            $table->integer('num_of_pax')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('telephone')->nullable()->change();
            $table->string('fax_no')->nullable()->change();
            $table->string('website')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('category')->nullable()->change();
            $table->date('fulfill_date')->nullable()->change();
            $table->date('issued_date')->nullable()->change();
            $table->date('expired_date')->nullable()->change();
            $table->date('doc_received_date')->nullable()->change();
            $table->string('advertised')->nullable()->change();
            $table->string('status')->nullable()->change();
            $table->string('doc_status')->nullable()->change();
            $table->string('doc_status_remarks')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('demand_informations', function (Blueprint $table) {
            $table->unsignedBigInteger('overseas_agent_id')->nullable(false)->change();
            $table->string('country')->nullable(false)->change();
            $table->integer('country_state_id')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->string('telephone')->nullable(false)->change();
            $table->string('fax_no')->nullable(false)->change();
            $table->string('website')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('category')->nullable(false)->change();
            $table->string('advertised')->nullable(false)->change();
            $table->string('status')->nullable(false)->change();
            $table->string('doc_status')->nullable(false)->change();
            $table->string('doc_status_remarks')->nullable(false)->change();
            $table->date('fulfill_date')->nullable(false)->change();
            $table->date('issued_date')->nullable(false)->change();
            $table->date('expired_date')->nullable(false)->change();
            $table->date('doc_received_date')->nullable(false)->change();
            $table->integer('num_of_pax')->nullable(false)->change();

        });
    }
};
