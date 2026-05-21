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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->integer('developer_id')->nullable();
            $table->string('title',255);
            $table->integer('region_id');
            $table->integer('province_id');
            $table->integer('city');
            $table->integer('barangay');
            $table->integer('category',11);
            $table->decimal('totalprice',10,2);
            $table->decimal('monthlyamortization',10,2)->nullable();
            $table->decimal('lotarea',10,2);
            $table->decimal('floorarea',10,2);
            $table->integer('bedroom');
            $table->integer('bathroom');
            $table->integer('garage')->default(0);
            $table->tinyInteger('exclusive')->default(0);
            $table->string('address',255);
            $table->string('latitude',50);
            $table->string('longitude',50);
            $table->text('description');
            $table->integer('created_by')->unsigned();
            $table->integer('modified_by')->unsigned()->nullable();
            $table->integer('status')->default(0);
            $table->integer('primary_photo')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('listings', function($table) {
           $table->foreign('created_by')->references('id')->on('users');
           $table->foreign('modified_by')->references('id')->on('users');
           //$table->foreign('primary_photo')->references('id')->on('listingphotos');
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
