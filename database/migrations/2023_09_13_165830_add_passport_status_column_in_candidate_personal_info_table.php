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
        Schema::table('candidate_personal_info', function (Blueprint $table) {
            $table->boolean('passport_status')->default(0)->after('passport_no');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_personal_info', function (Blueprint $table) {
            $table->dropColumn('passport_status');
        });
    }
};
