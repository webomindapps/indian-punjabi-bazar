<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'meta_tagable_id',
        'meta_tagable_type',
        'title',
        'description',
        'keywords'
    ];

    public function meta_tagable()
    {
        return $this->morphTo();
    }
}
