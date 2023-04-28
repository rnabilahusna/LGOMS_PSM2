<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->string('buyerCode')->primary();
            $table->string('authorizationCodeOrName');
            $table->string('buyerAddress');
            $table->string('buyerCorrespondentOrName');
            $table->string('buyerName');
            $table->string('buyerSectionCodeOrName');
            $table->string('contactNum');
            $table->string('email');
            $table->string('originCountry');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('client');
    }
};
