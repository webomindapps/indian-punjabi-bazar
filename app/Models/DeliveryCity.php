<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryCity extends Model
{
    use HasFactory;
    protected $fillable = [
        'city',
        'delivery_price',
        'min_amt_for_shipping',
        'status',
    ];
}