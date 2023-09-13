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
            $table->string('district')->nullable()->after('registration_no');
            $table->string('province')->nullable()->after('registration_no');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_personal_info', function (Blueprint $table) {
            $table->dropColumn('district');
            $table->dropColumn('province');
        });
    }
};
