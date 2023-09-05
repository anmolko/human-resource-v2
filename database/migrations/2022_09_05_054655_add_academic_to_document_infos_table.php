<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAcademicToDocumentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_infos', function (Blueprint $table) {
            $table->enum('original_academic', ['original','copy'])->after('academic_certificates')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_infos', function (Blueprint $table) {
            $table->dropColumn('original_academic');

        });
    }
}
