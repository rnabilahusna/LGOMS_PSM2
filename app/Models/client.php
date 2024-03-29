<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//model for Client table
class client extends Model
{
    public $table = 'client';
    use HasFactory;

    protected $fillable = [
        'buyerCode',
        'authorizationCodeOrName',
        'buyerAddress',
        'buyerCorrespondentOrName',
        'buyerName',
        'buyerSectionCodeOrName',
        'originCountry',
    ];
}