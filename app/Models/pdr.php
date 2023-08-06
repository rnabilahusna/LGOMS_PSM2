<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//pdr model
class pdr extends Model
{
    public $table = 'pdr';
    use HasFactory;

    protected $fillable = [
        'refNo',
        'JONo',
        'orderID',
        'PONo',
        'acceptedBy',
        'approvedBy',
        'balance',
        'buyerCode',
        'buyerName',
        'IssuedDate',
        'daysDelayed',
        'deliveredDate',
        'deliveryDate',
        'deliveryQuantity',
        'DINo',
        'DONoSales1',
        'DONoSales2',
        'jobOrderDate',
        'month',
        'no',
        'partIDOrName',
        'producedBy',
        'reportDate',
        'stock'
    ];

    //connect with 'order' table using Foreign Key 'id'
    public function getOrder() {
        return $this->belongsTo(order::class, 'id','id');
    }
        
    //connect with 'client' table using Foreign Key 'buyerCode'
    public function getClient() {
        return $this->belongsTo(client::class, 'buyerCode','buyerCode');
    }
}
