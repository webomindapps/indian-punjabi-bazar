<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\Tax;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

// 
class ProductImport implements SkipsEmptyRows, ToModel, WithHeadingRow, SkipsOnFailure, WithValidation, WithBatchInserts, WithChunkReading, WithUpserts
{
    use SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private $sku;
    public function model(array $row)
    {
        $this->sku = $row['sku'];
        $categories = explode(',', $row['category']);
        $images = explode(',', $row['images']);
        $category_ids = Category::whereIn('slug', $categories)->pluck('id');
        $brand = Brand::where('name', $row['brand'])->pluck('id')->first();
        $tax = Tax::where('title', $row['tax'])->pluck('id')->first();
        $special_price_from=null;
        $special_price_to=null;
        if (!is_null($row['special_price_from'])) {
            $special_price_from = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['special_price_from']);
        }
        if (!is_null($row['special_price_to'])) {
            $special_price_to = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['special_price_to']);
        }

        $product = Product::create([
            'name' => $row['name'],
            'sku' => $row['sku'],
            'url_key' => Str::slug($row['name']),
            'brand' => $brand,
            'tax_id' => $tax,
            'is_new' => $row['is_new']??0,
            'is_best_seller' => $row['is_best_seller']??0,
            'is_featured' => $row['is_featured']??0,
            'small_description' => $row['small_description']??'description',
            // 'description' => $row['description'],
            // 'how_to_use' => $row['how_to_use'],
            // 'ingredients' => $row['ingredients'],
            // 'disclaimer' => $row['disclaimer'],
            'price' => $row['price'],
            'cost' => $row['cost'],
            'weight_type' => $row['weight_type'],
            'weight' => $row['weight'],
            'special_price' => $row['special_price'],
            'special_price_from' => $special_price_from,
            'special_price_to' => $special_price_to,
        ]);

        $this->uploadProductCategories($product, $category_ids);
        $this->uploadProductImages($product, $images);

        // $product->metatag()->create([
        //     'title' => $row['meta_title'],
        //     'description' => $row['meta_description'],
        //     'keywords' => $row['meta_keywords'],
        // ]);
        $this->updateInventory($product, $row['inventory']);
        return $product;
    }
    public function rules(): array
    {
        return [
            'sku' => 'required|unique:products',
            'price' => 'required',
            'name' => 'required',
            'is_new' => 'required',
            'is_best_seller' => 'required',
            // 'small_description' => 'required',
            'inventory' => 'required',
        ];
    }
    private function uploadProductCategories($product, $category_ids)
    {
        foreach ($category_ids as $category_id) {
            $product->categories()->updateOrCreate([
                'category_id' => $category_id,
            ], [
                'category_id' => $category_id
            ]);
        }

        return true;
    }
    public function updateInventory($product, $inventory): ProductInventory
    {
        return $product->inventory()->updateOrCreate([
            'product_id' => $product->id,
        ], [
            'inventory' => $inventory
        ]);
    }
    private function uploadProductImages($product, $images): bool
    {
        $folder = 'products/' . $product->id;
        $destinationPath = storage_path('app/public/' . $folder);
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }
        $imagefiles = File::allFiles('storage/products/bulk-uploads/');
        foreach ($imagefiles as $image) {
            foreach ($images as $img) {
                if ($img == $image->getFilename()) {
                    $newPath = $folder . '/' . $image->getFilename();
                    File::move($image->getPathname(), storage_path('app/public/' . $newPath));
                    $product->images()->create([
                        'image_url' => $newPath
                    ]);
                }
            }
        }
        return true;
    }
    public function batchSize(): int
    {
        return 50;
    }

    public function chunkSize(): int
    {
        return 50;
    }
    public function uniqueBy()
    {
        return 'sku';
    }
}
