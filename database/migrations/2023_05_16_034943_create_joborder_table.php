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
        Schema::create('joborder', function (Blueprint $table) {
       
            $table->id();
            $table->string('JONo')->nullable();                     
            $table->string('PONo')->nullable();                     
            $table->string('buyerCode')->nullable();                
            $table->unsignedBigInteger('designID')->nullable();     
            $table->unsignedBigInteger('orderID')->nullable();      
            $table->unsignedBigInteger('PDRID')->nullable();        
            $table->date('AMDate')->nullable();                     
            $table->bigInteger('AMQty')->nullable();               
            $table->string('AuthorisedBy')->nullable();             
            $table->date('AuthorisedDate')->nullable();             
            $table->bigInteger('balance')->nullable();              
            $table->date('dateIn')->nullable();                     
            $table->date('dateOut')->nullable();                    
            $table->string('filmAvailable')->nullable();               
            $table->string('IssuedBy')->nullable();                 
            $table->date('IssuedDate')->nullable();                 
            $table->date('jobEndDate')->nullable();                 
            $table->date('jobStartDate')->nullable();               
            $table->date('JODate')->nullable();                   
            $table->bigInteger('no')->nullable();                   

            $table->string('noOfCavities')->nullable();         
            $table->string('noOfEnvelope')->nullable();         
            $table->string('noOfSheets')->nullable();           
            $table->string('otherMaterials')->nullable();       
            $table->string('adhesiveApplied')->nullable();      
            $table->string('PEFilmApplied')->nullable();        
            $table->bigInteger('POQuantity')->nullable();    


            $table->string('operatorName')->nullable();        
            $table->string('operatorSign')->nullable();         
            $table->string('output')->nullable();               
            $table->string('otyNoGood')->nullable();            

            $table->string('partDescription')->nullable();      
            $table->string('partNo')->nullable();               

            $table->string('POReceivedDate')->nullable();       
            $table->string('processesCarriedOut')->nullable();      
            $table->string('producedQty')->nullable();              
            $table->bigInteger('productJOQuantity')->nullable();    
            $table->date('productReadyDate')->nullable();           
            $table->string('qtyIn')->nullable();                    
            $table->string('rawMaterialApproved')->nullable();      
            $table->string('rawMaterialMain')->nullable();      
            $table->string('rejectedQty')->nullable();          
            $table->string('sampleAvailable')->nullable();      
            $table->string('size')->nullable();                 
            $table->string('stock')->nullable();                
            $table->string('stockUpdatedDate')->nullable();     
            $table->string('stockUpdatedQty')->nullable();      
            $table->string('thickness')->nullable();            


            $table->timestamps();
        });

        Schema::table('joborder', function(Blueprint $table){
            $table->foreign('buyerCode')->references('buyerCode')->on('client')->onDelete('cascade');
            $table->foreign('designID')->references('designID')->on('design')->onDelete('cascade');
            $table->foreign('orderID')->references('id')->on('order')->onDelete('cascade');
            $table->foreign('PDRID')->references('id')->on('pdr')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joborder');
    }
};
