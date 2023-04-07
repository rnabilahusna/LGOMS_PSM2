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
            $table->string('PONo');
            $table->string('designID');
            $table->string('actionCode');
            $table->string('amount');
            $table->string('comment')->nullable();
            $table->date('creationDate');
            $table->string('currencyCode');
            $table->date('deliveryDateETA');
            $table->date('IssuedDate');
            $table->integer('lineNo')->nullable();
            $table->string('orderStatus')->nullable();
            $table->string('partDescription')->nullable();
            $table->string('partNo');
            $table->string('paymentStatus');
            $table->string('paymentTerm');
            $table->string('placeOfDelivery')->nullable();
            $table->integer('quantity');
            $table->string('quantityPerPackageUOM');
            $table->string('QuotationNo')->nullable();
            $table->date('referenceDateETD');
            $table->string('remark')->nullable();
            $table->string('RONo')->nullable();
            $table->string('salesUnitPriceBasisUOM');
            $table->string('shippingMode');
            $table->string('shippingTerm');
            $table->string('termOfPayment');
            $table->float('unitPrice');
            $table->string('UOM');
            $table->timestamps();
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

