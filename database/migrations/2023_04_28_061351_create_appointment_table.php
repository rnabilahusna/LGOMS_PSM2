<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     * $table->bigIncrements('id').
     */
    public function up()
    {
        Schema::create('appointment', function (Blueprint $table) {
            $table->id('appID');
            $table->date('appDate');
            $table->string('appPurpose');
            $table->string('appStatus');
            $table->time('appTime');
            $table->timestamps();
            $table->string('buyerCode');
        });


        Schema::table('appointment', function(Blueprint $table){
            $table->foreign('buyerCode')->references('buyerCode')->on('client')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('appointment');
    }
};
