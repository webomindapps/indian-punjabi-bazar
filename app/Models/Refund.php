<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'refund_date',
        'total_amount',
        'refund_amount',
    ];

    public function items()
    {
        return $this->hasMany(RefundItem::class);
    }
}
