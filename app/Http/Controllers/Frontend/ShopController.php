<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\DeliveryCity;
use App\Models\Page;
use App\Models\Product;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function model()
    {
        return new Product;
    }
    public function index()
    {
        $health_goalsP = [];
        $top_categories = Category::tree()
            ->with('image')
            ->whereNotNull('parent_id')
            ->orderBy('position', 'asc')
            ->where('status', true)
            ->take(20)
            ->get();
        $health_goals = Category::where('slug', 'health-goals-and-concerns')->first();
        if ($health_goals) {
            $health_goalsP = Product::with('images', 'inventory', 'variants', 'variants.variant', 'variants.variant_value')
                ->whereHas('categories', function ($query) use ($health_goals) {
                    $query->where('category_id', $health_goals->id);
                })->take(15)->get();
        }
        $best_sellers = Product::with('images', 'inventory', 'variants', 'variants.variant', 'variants.variant_value')
            ->where('status', true)->where('is_best_seller', true)->take(15)->get();
        $new_launches = Product::with('images', 'inventory', 'variants', 'variants.variant', 'variants.variant_value')
            ->where('status', true)->where('is_new', true)->take(15)->get();
        $featured = Product::with('images', 'inventory', 'variants', 'variants.variant', 'variants.variant_value')
            ->where('status', true)->where('is_featured', true)->take(15)->get();
        $brands = Brand::where('status', 1)->latest()->get();
        $offers = Banner::where('type', 3)->orderBy('position', 'asc')->get();
        $sliders = Slider::all();
        return view('frontend.pages.index', compact('top_categories', 'best_sellers', 'new_launches', 'brands', 'sliders', 'featured', 'offers', 'health_goals'));
    }
    public function checkout()
    {
        $customer = Auth::guard('customer')->user();
        if ($customer) {
            $cart = Cart::where('customer_id', $customer->id)->latest()->first();
        } else {
            $cart_id = Session::get('cart_id');
            if ($cart_id) {
                $cart = $this->findBy('id', $cart_id);
            } else {
                $cart = null;
            }
        }

        if (is_null($cart)) {
            return redirect()->route('cart');
        }
        if ($cart && $cart->total_amount < 0 && $cart->type == 'delivery') {
            return redirect()->route('cart')->with('error', 'For delivery minimum amount should 50$');
        }
        $delivery_city = '';
        if ($cart->type == 'delivery') {
            $city = DeliveryCity::find($cart->city);
            $delivery_city = $city->city;
        } else {
            $delivery_city = ' Indian Punjabi Bazaar';
        }
        return view('frontend.pages.checkout', compact('cart', 'customer', 'delivery_city'));
    }

    public function productByCategory(Request $request, $slug)
    {
        $sort = $request->sort;
        $order = $request->order;
        $paginate = $request->paginate;
        $is_new = $request->is_new;
        $all = $request->all;
        $is_best_seller = $request->is_best_seller;
        $is_featured = $request->is_featured;
        $brand = $request->brand;
        $flavour = $request->flavour;
        $source = $request->source;
        $form = $request->form;
        $price = $request->price;
        $sale = $request->sale;
        $sub_categories = collect();
        $query = Product::query();
        $category = Category::where('slug', $slug)->first();

        if (!is_null($category)) {
            $category_children = $category->child()->pluck('id')->toArray();
            $categories_id = array_merge([$category->id], $category_children);
            $query->whereHas('categories', function ($query) use ($categories_id) {
                $query->whereIn('category_id', $categories_id);
            });
            $sub_categories = $category->descendants()->orderBy('name', 'asc')->get();
        }
        if ($brand) {
            $brand = explode(',', $brand);
            $query->whereHas('brand_name', function ($query) use ($brand) {
                $query->whereIn('brand', $brand);
            });
        }
        if ($flavour) {
            $flavour = explode(',', $flavour);
            $query->whereIn('flavour', $flavour);
        }
        if ($source) {
            $source = explode(',', $source);
            $query->whereIn('source', $source);
        }
        if ($form) {
            $form = explode(',', $form);
            $query->whereIn('form', $form);
        }
        if ($price) {
            $price = explode('-', $price);
            $query->whereBetween('price', $price);
        }
        if ($sale) {
            $today = Carbon::today();

            $query->where(function ($query) use ($today) {
                $query->whereNotNull('special_price_from')
                    ->where('special_price_from', '<=', $today);
            })->where(function ($query) use ($today) {
                $query->whereNotNull('special_price_to')
                    ->where('special_price_to', '>=', $today);
            });
        }
        if ($is_new) {
            $query->where('is_new', $is_new);
        }
        if ($is_best_seller) {
            $query->where('is_best_seller', $is_best_seller);
        }
        if ($is_featured) {
            $query->where('is_featured', $is_featured);
        }
        if ($slug == 'categorysearch') {
            $all = 'all';
        }
        ($sort == '') ? $query->orderBy('name', 'asc') : $query->orderBy($sort, $order);
        $query->where('status', true);
        $products = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(100)->appends(request()->query());
        if ($category || $brand || $is_new || $is_best_seller || $is_featured || $all || $sale) {
            return view('frontend.pages.product-list', compact('products', 'sub_categories', 'category'));
        } else {
            $product = Product::where('url_key', $slug)->first();
            if ($product) {
                $category = $product->categories()->pluck('category_id')->toArray();
                // if ($category) {
                //     $category = $category->category;
                // } else {
                //     $category = Category::latest()->first();
                // }
                // $sub_categories = $category->descendants()->pluck('id')->toArray();
                // $parent_categories = $category->ancestors()->pluck('id')->toArray();
                $relatedProducts = $this->getProductsByCategory($category);
                $recentIds = Session::get('recents', []);
                array_push($recentIds, $product->id);
                Session::put('recents', $recentIds);
                $recentViewed = Product::whereIn('id', $recentIds)->where('id', '<>', $product->id)->get();
                return view('frontend.pages.product-details', compact('product', 'relatedProducts', 'recentViewed'));
            } else {
                abort(404, 'Page not found');
            }
        }
    }

    public function activeProducts()
    {
        return $this->model()->with('images', 'inventory', 'variants', 'variants.variant', 'variants.variant_value')
            ->where('status', true);
    }

    public function getProductsByCategory($categories = [])
    {
        $products = $this->activeProducts()
            ->whereHas('categories', function ($subquery) use ($categories) {
                $subquery->whereIn('category_id', $categories);
            })
            ->paginate(60);

        return $products;
    }

    public function getProductsBy($type, $value, $limit = 0)
    {
        return $this->activeProducts()
            ->where($type, $value)
            ->take($limit)
            ->get();
    }
    public function searchProduct(Request $request)
    {
        $search = $request->search;
        $searchColumns = ['id', 'name', 'sku', 'url_key'];
        $products = null;
        $query = Product::where('status', true);

        if ($search != '') {

            $query->where(function ($query) use ($search, $searchColumns) {
                $query->whereHas('categories', function ($subquery) use ($search) {
                    $subquery->whereHas('category', function ($categoryQuery) use ($search) {
                        $categoryQuery->where('slug', 'like', '%' . $search . '%');
                    });
                })->orWhereHas('brand_name', function ($brandQuery) use ($search) {
                    $brandQuery->where('name', 'like', '%' . $search . '%');
                })
                    ->orWhere(function ($q) use ($search, $searchColumns) {
                        foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
                    });
            });
            $products = $query
                ->with('images', 'inventory', 'variants', 'variants.variant', 'variants.variant_value')->get();
        }

        return [
            'html' => view('frontend.pages.searched-items', compact('products'))->render()
        ];
    }

    public function pageDetails($page)
    {
        $pageDetails = Page::where('slug', $page)->first();
        if ($pageDetails) {
            return view('frontend.pages.page-view', compact('pageDetails'));
        } else {
            abort(404, 'Page not found');
        }
    }

    public function allBrands()
    {
        $brands = Brand::where('status', 1)->orderBy('name', 'asc')->get();
        return view('frontend.pages.brands', compact('brands'));
    }

    public function allCategories()
    {
        $health_goals = Category::where('slug', 'health-goals-and-concerns')->first();
        $childIds = $health_goals->child->pluck('id')->toArray();
        $categories = Category::where('status', 1)->orderBy('name', 'asc')->whereNotIn('id', $childIds)->get();
        return view('frontend.pages.categories', compact('categories'));
    }

    public function allHealths()
    {
        $health_goals = Category::where('slug', 'health-goals-and-concerns')->first();
        $categories = $health_goals->child;
        return view('frontend.pages.all-health-categories', compact('categories'));
    }
}
