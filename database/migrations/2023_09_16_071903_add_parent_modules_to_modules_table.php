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
        Schema::table('modules', function (Blueprint $table) {
            $table->integer('sub_parent_module_id')->unsigned()->nullable()->after('id');
            $table->integer('parent_module_id')->unsigned()->nullable()->after('id');
            $table->foreign('parent_module_id')->references('id')->on('modules')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sub_parent_module_id')->references('id')->on('modules')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->dropForeign(['parent_module_id']);
            $table->dropForeign(['sub_parent_module_id']);
            $table->dropColumn('parent_module_id');
            $table->dropColumn('sub_parent_module_id');
        });
    }
};
