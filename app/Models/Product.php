<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sku',
        'url_key',
        'brand',
        'is_new',
        'is_best_seller',
        'is_featured',
        'small_description',
        'description',
        'how_to_use',
        'ingredients',
        'disclaimer',
        'price',
        'cost',
        'special_price',
        'special_price_from',
        'special_price_to',
        'status',
        'tax_id',
        'weight_type',
        'weight',
        'flavour',
        'source',
        'form',
        'thumbnail',
        'in_stock',
    ];

    protected $with = [
        'images',
    ];

    public function metatag()
    {
        return $this->morphOne(MetaTag::class, 'meta_tagable');
    }
    public function brand_name()
    {
        return $this->belongsTo(Brand::class, 'brand', 'id');
    }


    public function categories()
    {
        return $this->hasMany(ProductCategory::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function inventory()
    {
        return $this->hasOne(ProductInventory::class, 'product_id');
    }

    public function tax()
    {
        return $this->hasOne(Tax::class, 'id', 'tax_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('status', true)->latest();
    }

    // protected static function newFactory()
    // {
    //     return \Modules\Product\Database\factories\ProductFactory::new();
    // }


    public function getInventory()
    {
        return $this->inventory ? $this->inventory->inventory : 0;
    }

    public function getMetaTags()
    {
        $metatag = $this->metatag ? $this->metatag : null;
        return [
            'title' => $metatag ? $metatag->title : '',
            'description' => $metatag ? $metatag->description : '',
            'keywords' => $metatag ? $metatag->keywords : '',
        ];
    }
}
