<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductForm;
use App\Models\ProductInventory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductUpdateImport implements SkipsEmptyRows, ToModel, WithHeadingRow, SkipsOnFailure, WithBatchInserts, WithChunkReading
{
    use SkipsFailures;
    /**
     * @param Collection $collection
     */
    private $sku;
    public function model(array $row)
    {
        $this->sku = $row['sku'];
        $product = Product::where('sku', $this->sku)->first();
        // $brand = Brand::where('name', $row['brand'])->pluck('id')->first();
        // $form = ProductForm::where('form', $row['form'])->pluck('id')->first();
        if (!is_null($product)) {
            $product->update([
                'sku' => '0' . $row['sku'],
                // 'brand' => $brand,
                // 'form' => $form,
                // 'weight_type' => $row['weight_type'],
                // 'weight' => null,
                // 'flavour' => $row['flavour'],
                // 'source'  => $row['source'],
                // 'form'    => $row['form'],
                // 'status'  => $row['status'],
                // 'weight_type' => $row['weight_type'],
            ]);
        }
        // $this->updateInventory($product, $row['quantity']);
    }
    // public function updateInventory($product, $inventory): ProductInventory
    // {
    //     return $product->inventory()->updateOrCreate([
    //         'product_id' => $product->id,
    //     ], [
    //         'inventory' => $inventory
    //     ]);
    // }
    public function batchSize(): int
    {
        return 50;
    }

    public function chunkSize(): int
    {
        return 50;
    }
}
