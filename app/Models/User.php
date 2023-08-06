<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

//Model for User table
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
        'contactNum',
        'buyerCode',
        'staffID',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //link with the staff table using the Foreign Key 'staffID'
    public function getStaff() {
        return $this->belongsTo(staff::class, 'staffID','staffID');
    }

    //link with the client table using the Foreign Key 'buyerCode'
    public function getClient() {
        return $this->belongsTo(client::class, 'buyerCode','buyerCode');
    }
    
}
