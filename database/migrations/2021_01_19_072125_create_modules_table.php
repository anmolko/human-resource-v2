<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->timestamps();Schema::create('modules', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->string('key')->unique();
                $table->string('url')->unique();
                $table->boolean('status')->default(0);
                $table->integer('created_by')->unsigned();
                $table->integer('updated_by')->nullable()->unsigned();
                $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                $table->timestamps();
                $table->softDeletes();

            });
    
            Schema::create('module_role', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('module_id')->unsigned();
                $table->integer('role_id')->unsigned();
                $table->foreign('module_id')->references('id')->on('modules')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_role');
        Schema::dropIfExists('modules');
    }
}
