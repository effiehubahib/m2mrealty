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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');

            $table->string('firstname',50);
            $table->string('lastname',50);
            $table->string('middlename',50)->nullable();
            $table->string('avatar')->nullable();
            $table->bigInteger('sponsorid')->default(1);
            $table->tinyInteger('status');
            $table->integer('jobposition')->nullable();
            $table->tinyInteger('gender')->comment('0-Female,1-Male');
            $table->enum('maritalstatus',['Single','Married','Widow','Widower']);
            $table->string('facebookurl',50)->nullable();
            $table->string('bankaccount',50)->nullable();
            $table->string('youtubeurl',50)->nullable();
            $table->integer('region_id');
            $table->integer('province_id');
            $table->integer('citymun_id');
            $table->integer('branch_id')->nullable();
            $table->string('address',255)->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name');

            $table->dropColumn([
                'firstname',
                'lastname',
                'middlename',
            ]);
        });
    }
};
