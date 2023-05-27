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
        'orderD',
        'PDRID',
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
        'noOfCavities',
        'noOfEnvelope',
        'noOfSheets',
        'otherMaterials',
        'adhesiveApplied',
        'PEFilmApplied',
        'POQuantity',
        'operatorName',
        'operatorSign',
        'output',
        'otyNoGood',
        'partDescription',
        'partNo',
        'POReceivedDate',
        'processesCarriedOut',
        'producedQty',
        'productJOQuantity',
        'productReadyDate',
        'qtyIn',
        'rawMaterialApproved',
        'rawMaterialMain',
        'rejectedQty',
        'sampleAvailable',
        'size',
        'stock',
        'stockUpdatedDate',
        'stockUpdatedQty',
        'thickness'
    ];

    public function getOrder() {
        return $this->belongsTo(order::class, 'id','id');
    }
    public function getClient() {
        return $this->belongsTo(client::class, 'buyerCode','buyerCode');
    }

    public function getDesign() {
        return $this->belongsTo(design::class, 'designID','designID');
    }
    public function getPDR() {
        return $this->belongsTo(pdr::class, 'JONo','JONo');
    }

    public function getJO() {
        return $this->hasMany(joborder::class, 'PDRID');
    }
   
    
}
