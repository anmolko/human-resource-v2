<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueTypeColumnInAttributeSecondaryGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attribute_secondary_group', function (Blueprint $table) {
            $table->string('type')->after('secondary_group_id')->nullable();
            $table->string('value')->after('secondary_group_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attribute_secondary_group', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('value');
        });
    }
}
