<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    public $table = 'staff';
    use HasFactory;

    protected $fillable = [
        'fullname',
        'ICNo',
        'citizenship',
        'contactNum',
        'staffID',
        'department',
        'email',
        'password'
    ];
}
