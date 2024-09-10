<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Http\Services\Helpers\Punjabi;
use App\Imports\ProductImport;
use App\Imports\ProductUpdateImport;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Flavour;
use App\Models\Product;
use App\Models\ProductForm;
use App\Models\ProductImage;
use App\Models\ProductInventory;
use App\Models\ProductSource;
use App\Models\ProductVariant;
use App\Models\Tax;
use App\Models\Unit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

use ZipArchive;

class ProductController extends Controller
{
    public function model()
    {
        return new Product;
    }
    public function index()
    {
        $searchColumns = ['id', 'name', 'sku', 'url_key'];
        $search = request()->search;
        $category_id = request()->category_id;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;
        $type = request()->type;
        $category = request()->category;
        $from_date = request()->from_date;
        $to_date = request()->to_date;

        $query = $this->model()->query();
        if ($from_date && $to_date) {
            $query->whereBetween('created_at', [$from_date, $to_date]);
        }
        if ($category_id != '') {
            $query->whereHas('categories', function ($q) use ($category_id) {
                $q->where('category_id', $category_id);
            });
        }
        if ($category != '') {
            $cat_id = Category::where('slug', $category)->first()->id;
            $query->whereHas('categories', function ($q) use ($cat_id) {
                $q->where('category_id', $cat_id);
            });
        }
        $today = date('Y-m-d');
        if ($type) {
            switch ($type) {
                case 'new':
                    $query->where('is_new', 1);
                    break;
                case 'best-seller':
                    $query->where('is_best_seller', 1);
                    break;
                case 'on-sale':
                    $query->where('special_price_from', '<=', $today)
                        ->where('special_price_to', '>=', $today);
                    break;
                default:
                    $query->where('is_featured', 1);
                    break;
            }
        }
        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $products = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        $categories = Category::where('status', 1)->get();
        return view('admin.product.index', compact('products', 'categories'));
    }
    public function create()
    {
        $brands = Brand::where('status', 1)->get();
        $taxes = Tax::where('status', 1)->get();
        $units = Unit::all();
        $flavours = Flavour::all();
        $sources = ProductSource::all();
        $forms = ProductForm::all();
        return view('admin.product.create', compact('brands', 'taxes', 'units', 'flavours', 'sources', 'forms'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|unique:products',
            'price' => 'required',
            'name' => 'required',
            'small_description' => 'required',
            'category_id' => 'required|array',
        ], ['category_id.required' => '* Category is required']);
        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['url_key'] = Str::slug($request->name);
            $folder = 'product/thumbnails';
            if ($request->file('thumbnail')) {
                $path = Punjabi::upload($request->file('thumbnail'), $folder);
                $data['thumbnail'] = $path;
            }
            $product = Product::create($data);

            //add product categories
            $this->uploadProductCategories($product, $request);

            //add meta tag details
            $data = [
                'title' => $request->meta_title,
                'description' => $request->meta_description,
                'keywords' => $request->keywords,
            ];
            $product->metatag()->create($data);

            //upload product images
            $this->uploadProductImages($product, $request);

            //update inventory
            $this->updateInventory($product, $request->default);

            //add product variants
            // $this->uploadProductVariants($product, $request);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect()->route('products')->with('success', 'Product added successfully');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $brands = Brand::where('status', 1)->get();
        $taxes = Tax::where('status', 1)->get();
        $units = Unit::all();
        $flavours = Flavour::all();
        $sources = ProductSource::all();
        $forms = ProductForm::all();
        return view('admin.product.update', compact('product', 'brands', 'taxes', 'units', 'flavours', 'sources', 'forms'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'sku' => 'required|unique:products',
            'price' => 'required',
            'name' => 'required',
            'small_description' => 'required',
            'category_id' => 'required|array',
        ], ['category_id.required' => '* Category is required']);
        $product = Product::find($id);
        // dd($request->all(),$product);
        DB::beginTransaction();
        try {

            $data = $request->all();
            $data['url_key'] = Str::slug($request->name);
            $data['is_new'] = isset($request->is_new) ? $request->is_new : 0;
            $data['is_best_seller'] = isset($request->is_best_seller) ? $request->is_best_seller : 0;
            $data['is_featured'] = isset($request->is_featured) ? $request->is_featured : 0;
            $data['in_stock'] = isset($request->in_stock) ? $request->in_stock : 0;

            $folder = 'product/thumbnails';
            if ($request->file('thumbnail')) {
                $path = Punjabi::upload($request->file('thumbnail'), $folder);
                $data['thumbnail'] = $path;
            }

            $product->update($data);

            //add product categories
            $product->categories()->delete();
            $this->uploadProductCategories($product, $request);

            //add meta tag details
            $product->metatag()->delete();
            $data = [
                'title' => $request->meta_title,
                'description' => $request->meta_description,
                'keywords' => $request->keywords,
            ];
            $product->metatag()->create($data);

            //upload product images
            if ($request->file('product_images') != null) {
                $this->uploadProductImages($product, $request);
            }

            //update inventory
            $this->updateInventory($product, $request->default);

            //add product variants
            // if (count($request->variant) > 0 && $request->variant[0] != null) {

            //     $this->uploadProductVariants($product, $request);
            // }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect()->route('products')->with('success', 'Product updated successfully');
    }

    private function uploadProductCategories($product, $request): bool
    {
        foreach ($request->category_id as $category_id) {
            $product->categories()->updateOrCreate([
                'category_id' => $category_id,
            ], [
                'category_id' => $category_id
            ]);
        }

        return true;
    }

    private function uploadProductImages($product, $request): bool
    {
        $folder = 'products/' . $product->id;
        if ($request->file('product_images')) {
            foreach ($request->file('product_images') as $image) {
                $path = Punjabi::upload($image, $folder);
                $product->images()->create([
                    'image_url' => $path
                ]);
            }
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
    private function uploadProductVariants($product, $request): bool
    {
        $variant_ids = $request->variant_ids;
        if ($variant_ids && count($variant_ids) > 0) {
            $this->addOrUpdateProductVariante($product, $variant_ids, $request);
        } else {
            $this->addProductVariant($product, $request);
        }
        return true;
    }


    private function addProductVariant($product, $request)
    {
        $variants = $request->variant;
        $variant_values = $request->variant_value;
        $variant_images = isset($request->variant_image) ? $request->variant_image : null;

        foreach ($variant_values as $key => $value) {
            $this->addVariant($product, $variants, $variant_values, $variant_images, $key);
        }
    }

    private function addOrUpdateProductVariante($product, $variant_ids, $request)
    {
        $variants = $request->variant;
        $variant_values = $request->variant_value;
        $variant_images = isset($request->variant_image) ? $request->variant_image : null;

        foreach ($variant_ids as $key => $value) {
            if ($value && $value != '') {
                $prd_variant = $product->variants()->where('id', $value)->first();
                if ($variant_images && count($variant_images) > 0 && isset($variant_images[$key])) {
                    $folder = 'products/' . $product->id . '/variant';
                    $path = Punjabi::upload($variant_images[$key], $folder);
                } else {
                    $path = $prd_variant->variant_image;
                }
                $prd_variant->update([
                    'variant_id' => $variants[$key],
                    'variant_value_id' => $variant_values[$key],
                    'variant_image' => $path,
                ]);
            } else {
                $this->addVariant($product, $variants, $variant_values, $variant_images, $key);
            }
        }
    }

    public function addVariant($product, $variants, $variant_values, $variant_images, $key)
    {
        if ($variant_images && count($variant_images) > 0 && isset($variant_images[$key])) {
            $folder = 'products/' . $product->id . '/variant';
            $path = Punjabi::upload($variant_images[$key], $folder);
        } else {
            $path = null;
        }
        if ($variants[$key]) {
            $product->variants()->create([
                'variant_id' => $variants[$key],
                'variant_value_id' => $variant_values[$key],
                'variant_image' => $path,
            ]);
        }
    }

    public function varianteDelete($id)
    {
        ProductVariant::destroy($id);
        return back()->with('success', 'variant deleted successfully');
    }
    public function imageDelete($id)
    {
        ProductImage::destroy($id);
        return back()->with('success', 'Product Image deleted successfully');
    }

    public function deleteSelected(Request $request)
    {
        Product::whereIn('id', $request->ids)->delete();
        return response()->json(['message' => 'Products deleted successfully']);
    }
    public function bulkStsChng(Request $request)
    {
        $ids = $request->ids;
        for ($i = 0; $i < count($ids); $i++) {
            $product = Product::find($ids[$i]);
            $product->update(['status' => $request->status]);
        }
    }
    public function bulkCategory(Request $request)
    {
        $productIds = explode(',', $request->product_ids);
        for ($i = 0; $i < count($productIds); $i++) {
            $product = Product::find($productIds[$i]);
            $product->categories()->delete();
            foreach ($request->category_id as $category_id) {
                $product->categories()->updateOrCreate([
                    'category_id' => $category_id,
                ], [
                    'category_id' => $category_id
                ]);
            }
        }
        return redirect()->route('products')->with('success', 'Product updated successfully');
    }
    public function massCategoryUpdate(Request $request)
    {
        $ids = $request->input('ids');
        return view('admin.product.mass_category_update', compact('ids'));
    }
    public function updateName(Request $request)
    {
        $product = Product::find($request->id);
        $product->update(['name' => $request->new_name]);
        return response()->json(['message' => 'Products updated successfully']);
    }
    public function updatePrice(Request $request)
    {
        $product = Product::find($request->id);
        $product->update(['price' => $request->new_price]);
        return response()->json(['message' => 'Products updated successfully']);
    }

    public function bulkUploadView()
    {
        return view('admin.product.bulk-upload');
    }
    public function bulkUpload(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx',
            'imageZip' => 'required|file|mimes:zip'
        ]);
        $zip = new ZipArchive();
        if ($zip->open($request->imageZip) === TRUE) {
            $zip->extractTo('storage/products/bulk-uploads/');
            $zip->close();
        }
        $file = $request->excel;
        $import = new ProductImport();
        Excel::import($import, $file);
        $error = '';
        foreach ($import->failures() as $failure) {
            $failure->row();
            $failure->attribute();
            $failure->errors();
            $failure->values();
            $error .= 'Row no:-' . $failure->row() . ', Column:-' . $failure->attribute() . ', Error:-' . $failure->errors()[0] . '<br>';
        }
        return redirect()->route('products')->with(['success' => 'Products added successfully', 'error_msg' => $error]);
    }
    public function destroy($id)
    {
        Product::destroy($id);
        return back()->with('message', 'Product deleted successfully');
    }
    public function export()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }
    public function bulkUpdateImport(Request $request)
    {
        $file = $request->excel;
        $import = new ProductUpdateImport();
        Excel::import($import, $file);
        return back()->with('message', 'successfully  imported');
    }
}
