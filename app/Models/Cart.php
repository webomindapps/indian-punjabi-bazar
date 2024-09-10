<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'shipping_method',
        'coupon_code',
        'items_count',
        'items_qty',
        'total_amount',
        'tax_total',
        'tax',
        'discount_amount',
        'grand_total',
        'type',
        'date',
        'time',
        'price',
        'min_price',
        'city',
    ];

    protected $with = [
        'items',
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
    public function coupon()
    {
        return $this->hasOne(Coupon::class, 'name', 'coupon_code');
    }
}
