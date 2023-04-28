<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class design extends Model
{
    public $table = 'design';
    protected $primaryKey = "designID";
    use HasFactory;

    protected $fillable = [
        // 'designID',
        'designConfirmationStatus',
        'goodsStock',
        'noOfCavities',
        'noOfEnvelope',
        'noOfSheets',
        'otherMaterials',
        'partDescription',
        'partDesign',
        'partNo',
        'PEFilmApplied',
        'POQty',
        'rawMaterialMain',
        'size',
        'thickness',
        'buyerCode'
    ];

    public function getClient() {
        return $this->belongsTo(client::class, 'buyerCode','buyerCode');
    }

    public function getOrder() {
        return $this->belongsTo(order::class, 'unitPrice','unitPrice');
    }
}
