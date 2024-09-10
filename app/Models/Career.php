<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'dob',
        'position',
        'city',
        'province',
        'pincode',
        'address',
        'applied_at',
        'comments',
        'resume',
        'status',
        'availability',
    ];
}
