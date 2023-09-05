<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondaryGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secondary_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('primary_group_id')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->boolean('status')->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('primary_group_id')->references('id')->on('primary_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });



        Schema::create('attribute_secondary_group', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('secondary_group_id');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('secondary_group_id')->references('id')->on('secondary_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_secondary_group');
        Schema::dropIfExists('secondary_groups');
    }
}
