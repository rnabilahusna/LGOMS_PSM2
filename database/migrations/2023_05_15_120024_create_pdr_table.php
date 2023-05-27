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
        Schema::create('pdr', function (Blueprint $table) {
            $table->id();
            $table->string('refNo')->nullable();
            $table->string('JONo')->nullable();
            $table->unsignedBigInteger('orderID');
            $table->string('PONo')->nullable();
            $table->string('acceptedBy')->nullable();
            $table->string('approvedBy')->nullable();
            $table->bigInteger('balance')->nullable();
            $table->string('buyerCode');
            $table->string('buyerName')->nullable();
            $table->date('IssuedDate')->nullable();
            $table->bigInteger('daysDelayed')->nullable();
            $table->date('deliveredDate')->nullable();
            $table->date('deliveryDate')->nullable();
            $table->string('deliveryQuantity')->nullable();
            $table->string('DINo')->nullable();
            $table->string('DONoSales1')->nullable();
            $table->string('DONoSales2')->nullable();
            $table->date('jobOrderDate')->nullable();
            $table->string('month')->nullable();
            $table->bigInteger('no')->nullable();
            $table->string('partIDOrName');
            $table->string('producedBy')->nullable();
            $table->date('reportDate')->nullable();
            $table->bigInteger('stock')->nullable();
            $table->timestamps();
        });

        Schema::table('pdr', function(Blueprint $table){
            $table->foreign('buyerCode')->references('buyerCode')->on('client')->onDelete('cascade');
            $table->foreign('orderID')->references('id')->on('order')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdr');
    }
};
