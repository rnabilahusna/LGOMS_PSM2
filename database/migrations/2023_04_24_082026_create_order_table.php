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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('PONo')->nullable();
            $table->string('actionCode');
            $table->string('amount')->nullable();
            $table->string('comment')->nullable();
            $table->date('creationDate');
            $table->string('currencyCode')->nullable();
            $table->date('deliveryDateETA')->nullable();
            $table->date('IssuedDate')->nullable();
            $table->integer('lineNo')->nullable();
            $table->string('orderStatus');
            $table->string('partDescription')->nullable();
            $table->string('partNo');
            $table->string('paymentStatus')->nullable();
            $table->string('paymentProof')->nullable();
            $table->string('paymentTerm')->nullable();
            $table->string('placeOfDelivery')->nullable();
            $table->integer('quantity');
            $table->string('quantityPerPackageUOM');
            $table->string('QuotationNo')->nullable();
            $table->date('referenceDateETD')->nullable();
            $table->string('remark')->nullable();
            $table->string('RONo')->nullable();
            $table->string('salesUnitPriceBasisUOM')->nullable();
            $table->string('shippingMode')->nullable();
            $table->string('shippingTerm')->nullable();
            $table->string('termOfPayment')->nullable();
            $table->float('unitPrice')->nullable();
            $table->string('UOM')->nullable();
            $table->string('buyerCode');
            $table->foreignId('designID')->references('designID')->on('design')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('order', function(Blueprint $table){
            $table->foreign('buyerCode')->references('buyerCode')->on('client')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
};

