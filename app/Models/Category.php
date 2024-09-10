<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model
{
    use HasFactory, HasRecursiveRelationships;
    protected $fillable = [
        'parent_id',
        'name',
        'position',
        'slug',
        'description',
        'status',
        'icon'
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function metatag()
    {
        return $this->morphOne(MetaTag::class, 'meta_tagable');
    }

    protected function icon(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('storage/' . $value) : '',
        );
    }

    public function getImage()
    {
        return $this->image ? asset('storage/' . $this->image->path) : null;
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
    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->where('status', true)->orderBy('position', 'asc');
    }
    public function products()
    {
        return $this->hasMany(ProductCategory::class, 'category_id');
    }
}
