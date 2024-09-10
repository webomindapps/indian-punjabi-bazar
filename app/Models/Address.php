<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => $this->first_name . ' ' . $this->last_name,
        );
    }
}
