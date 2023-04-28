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
        Schema::create('design', function (Blueprint $table) {
            $table->id('designID');
            $table->string('designConfirmationStatus');
            $table->integer('goodsStock')->nullable();
            $table->string('noOfCavities')->nullable();
            $table->string('noOfEnvelope')->nullable();
            $table->string('noOfSheets')->nullable();
            $table->string('otherMaterials')->nullable();
            $table->string('partDescription')->nullable();
            $table->string('partDesign');
            $table->string('partNo');
            $table->string('PEFilmApplied')->nullable();
            $table->string('POQty')->nullable();
            $table->string('rawMaterialMain')->nullable();
            $table->string('size')->nullable();
            $table->string('thickness')->nullable();
            $table->string('buyerCode');
            $table->timestamps();
        });


        Schema::table('design', function(Blueprint $table){
            $table->foreign('buyerCode')->references('buyerCode')->on('client')->onDelete('cascade');
        });


    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('design');
    }
};


