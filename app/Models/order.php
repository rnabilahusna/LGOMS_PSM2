<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    public $table = 'order';
    use HasFactory;

    protected $fillable = [
        'PONo',
        'designID',
        'actionCode',
        'amount',
        'comment',
        'creationDate',
        'currencyCode',
        'deliveryDateETA',
        'IssuedDate',
        'lineNo',
        'orderStatus',
        'partDescription',
        'partNo',
        'paymentStatus',
        'paymentTerm',
        'placeOfDelivery',
        'quantity',
        'quantityPerPackageUOM',
        'QuotationNo',
        'referenceDateETD',
        'remark',
        'RONo',
        'salesUnitPriceBasisUOM',
        'shippingMode',
        'shippingTerm',
        'termOfPayment',
        'unitPrice',
        'UOM'
    ];
}
