<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

//order model
class order extends Model
{
    public $table = 'order';
    use HasFactory, Notifiable;

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

    //connect to table 'client' using Foreign Key 'buyerCode'
    public function getClient() {
        return $this->belongsTo(client::class, 'buyerCode','buyerCode');
    }

    //connect to table 'design' using Foreign Key 'designID'
    public function getDesign() {
        return $this->belongsTo(design::class, 'designID','designID');
    }

    //get multiple rows of order for a single client
    //establishes a one-to-many relationship
    public function getMyOrder(){
        return $this->hasMany(order::class,'id')->with('row');
    }

    //connect to table 'pdr' using Foreign Key 'id'
    public function getPDR() {
        return $this->belongsTo(pdr::class, 'id','id');
    }

    //connect to table 'joborder' using Foreign Key 'id'
    public function getJO() {
        return $this->belongsTo(joborder::class, 'id','id');
    }

}
