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
        Schema::create('developers', function (Blueprint $table) {
            $table->id();
            $table->string('developername',100);
            $table->string('address',255);
            $table->string('logo',100)->nullable();
            $table->string('slug');
            $table->string('website',50)->nullable();
            $table->string('contactperson',100)->nullable();
            $table->string('mobilenumber',50)->nullable();
            $table->string('telephonenumber',50)->nullable();
            $table->string('email')->nullable();
            $table->string('latitude',50)->nullable();
            $table->string('longitude',50)->nullable();
            $table->text('description')->nullable();
            $table->text('facebooklink')->nullable();
            $table->integer('status')->default(0);
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('modified_by')->nullable()->unsigned();
            $table->timestamps();
        });
        Schema::table('developers', function($table) {
           $table->foreign('created_by')->references('id')->on('users');
           $table->foreign('modified_by')->references('id')->on('users');
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developers');
    }
};
