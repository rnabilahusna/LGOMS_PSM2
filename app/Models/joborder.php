<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//joborder model
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

    //connect with 'order' table using Foreign Key 'id'
    public function getOrder() {
        return $this->belongsTo(order::class, 'id','id');
    }
    //connect with 'client' table using Foreign Key 'buyerCode'
    public function getClient() {
        return $this->belongsTo(client::class, 'buyerCode','buyerCode');
    }
    //connect with 'design' table using Foreign Key 'designID'
    public function getDesign() {
        return $this->belongsTo(design::class, 'designID','designID');
    }
    //connect with 'PDR' table using Foreign Key 'JONo'
    public function getPDR() {
        return $this->belongsTo(pdr::class, 'JONo','JONo');
    }
    //establishes a one-to-many relationship
    public function getJO() {
        return $this->hasMany(joborder::class, 'PDRID');
    }
    
}
