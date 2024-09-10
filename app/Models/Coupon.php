<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'coupon',
        'from',
        'to',
        'discount_type',
        'discount_type_value',
        'is_condition_coupon',
        'min_amount_for_discount',
        'max_discount_amount',
        'status',
    ];
}
