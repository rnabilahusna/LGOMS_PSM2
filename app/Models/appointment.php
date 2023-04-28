<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Appointment extends Model
{
    use HasFactory;

    protected $table = "appointment";
    protected $primaryKey = "appID";
    protected $fillable = [
        'appID',
        'appDate',
        'appPurpose',
        'appStatus',
        'appTime',
        'buyerCode'
    ];

    public $timestamps = false;

    public function getClient() {
        return $this->belongsTo(client::class, 'buyerCode','buyerCode');
    }

}

