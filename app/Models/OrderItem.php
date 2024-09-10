<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'quantity',
        'sku',
        'coupon_code',
        'price',
        'total_amount',
        'tax_percent',
        'tax_amount'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
