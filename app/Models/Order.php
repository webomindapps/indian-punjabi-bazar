<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'address_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'shipping_method',
        'coupon_code',
        'items_count',
        'items_qty',
        'total_amount',
        'tax_total',
        'tax',
        'discount_amount',
        'grand_total',
        'status',
        'delivery_date',
        'note',
        'is_invoice_created',
        'invoice_date',
        'is_shipped',
        'shipped_date',
        'is_refunded',
        'refund_date',
        'delivery_type',
        'date',
        'time',
        'delivery_charge',
        'min_price',
        'city',
        'shipment_name',
        'shipment_id',
        'tracking_id',
        'payment_id',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function deliveryCity(){
        return $this->hasOne(DeliveryCity::class,'id','city');
    }

    public function refund(){
        return $this->hasOne(Refund::class);
    }
}
