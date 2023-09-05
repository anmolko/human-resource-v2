<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentProcessingFeeToCandidatePersonalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_personal_info', function (Blueprint $table) {
            $table->string('document_processing_fee')->after('receipt_no')->nullable();
            $table->string('advance_fee')->after('receipt_no')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_personal_info', function (Blueprint $table) {
            $table->dropColumn('document_processing_fee');
            $table->dropColumn('advance_fee');

        });
    }
}
