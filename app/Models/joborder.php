<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class joborder extends Model
{
    public $table = 'joborder';
    use HasFactory;

    protected $fillable = [
        'JONo',
        'PONo',
        'buyerCode',
        'designID',
        'AMDate',
        'AMQty',
        'AuthorisedBy',
        'AuthorisedDate',
        'balance',
        'dateIn',
        'dateOut',
        'filmAvailable',
        'IssuedBy',
        'IssuedDate',
        'jobEndDate',
        'jobStartDate',
        'JODate',
        'no',
        'operatorName',
        'operatorSign',
        'output',
        'POReceivedDate',
        'processesCarriedOut',
        'producedQty',
        'productJOQuantity',
        'productReadyDate',
        'qtyIn',
        'qtyNoGood',
        'rawMaterialApproved',
        'rejectedQty',
        'sampleAvailable',
        'stock',
        'stockUpdatedDate',
        'stockUpdatedQty',
    ];

    
}
