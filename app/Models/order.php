<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    public $table = 'order';
    // protected $primaryKey = "PONo";
    use HasFactory;

    protected $fillable = [
        'PONo',
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
        'paymentProof',
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
        'UOM',
        'buyerCode',
        'designID',
    ];

    public function getClient() {
        return $this->belongsTo(client::class, 'buyerCode','buyerCode');
    }

    public function getDesign() {
        return $this->belongsTo(design::class, 'designID','designID');
    }

    public function getMyOrder(){
        return $this->hasMany(order::class,'id')->with('row');
    }

    
}
