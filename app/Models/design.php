<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//design model
class design extends Model
{
    public $table = 'design';
    //primary key of table design 
    protected $primaryKey = "designID";
    use HasFactory;

    protected $fillable = [
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
        'unitPrice',
        'buyerCode'
    ];

    //connect 'design' table with 'client' table using the Foreign Key 'buyerCode'
    public function getClient() {
        return $this->belongsTo(client::class, 'buyerCode','buyerCode');
    }

    //connect 'design' table with 'order' table using the Foreign Key 'unitPrice'
    public function getOrder() {
        return $this->belongsTo(order::class, 'unitPrice','unitPrice');
    }

    //get multiple rows of design for a single client
    //establishes a one-to-many relationship
    public function getMyDesign(){
        return $this->hasMany(design::class,'designID')->with('row');
    }
}
