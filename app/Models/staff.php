<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Model for Staff table
class staff extends Model
{
    public $table = 'staff';
    use HasFactory;

    protected $fillable = [
        'staffID',
        'name',
        'ICNo',
        'citizenship',
        'department',
    ];
}
