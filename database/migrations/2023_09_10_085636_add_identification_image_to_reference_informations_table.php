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
        Schema::table('reference_informations', function (Blueprint $table) {
             $table->string('identification_image')->nullable()->after('email_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reference_informations', function (Blueprint $table) {
            $table->dropColumn('identification_image');
        });
    }
};
