<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class design extends Model
{
    public $table = 'design';
    use HasFactory;

    protected $fillable = [
        'designID',
        'buyerCode',
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
        'thickness'
    ];
}
