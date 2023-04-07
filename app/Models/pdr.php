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
        'PONo',
        'approvedBy',
        'approvedDate',
        'approvedTime',
        'clientName',
        'dateOfIssue',
        'daysDelayed',
        'deliveredDate',
        'deliveryDate',
        'deliveryQuantity',
        'DINo',
        'DONoSales',
        'jobOrderDate',
        'month',
        'no',
        'partIDOrName',
        'producedBy',
        'reportDate',
        'stock'
    ];
}
