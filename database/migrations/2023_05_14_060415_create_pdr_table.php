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
            $table->string('refNo');
            $table->string('JONo')->nullable();
            $table->unsignedBigInteger('orderID');
            $table->string('PONo');
            $table->string('acceptedBy')->nullable();
            $table->string('approvedBy');
            $table->bigInteger('balance')->nullable();
            $table->string('buyerCode');
            $table->string('buyerName');
            $table->date('IssuedDate');
            $table->bigInteger('daysDelayed')->nullable();
            $table->date('deliveredDate')->nullable();
            $table->date('deliveryDate');
            $table->string('deliveryQuantity');
            $table->string('DINo');
            $table->string('DONoSales1')->nullable();
            $table->string('DONoSales2')->nullable();
            $table->date('jobOrderDate')->nullable();
            $table->string('month')->nullable();
            $table->bigInteger('no');
            $table->string('partIDOrName');
            $table->string('producedBy');
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
