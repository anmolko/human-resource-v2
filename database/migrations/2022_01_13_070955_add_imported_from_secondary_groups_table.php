<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImportedFromSecondaryGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('secondary_groups', function (Blueprint $table) {
            $table->enum('imported_from', ['true','false'])->after('status')->default('false');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('secondary_groups', function (Blueprint $table) {
            $table->dropColumn('imported_from');

        });
    }
}
