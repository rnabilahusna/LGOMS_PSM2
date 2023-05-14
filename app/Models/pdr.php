<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function getOrder() {
        return $this->belongsTo(order::class, 'id','id');
    }
    public function getClient() {
        return $this->belongsTo(order::class, 'buyerCode','buyerCode');
    }
}
