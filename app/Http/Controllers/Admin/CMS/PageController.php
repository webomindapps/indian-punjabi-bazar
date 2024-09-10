<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Career;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Newsletter;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\Review;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchColumns = ['id', 'name', 'title'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;
        $query = Page::query();
        if ($search != '') {
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });
        }
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);
        $pages = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.cms.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cms.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'title' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'keywords' => 'required',
        ]);
        Page::create([
            'name' => $request->name,
            'position' => $request->position,
            'slug' => Str::slug($request->name),
            'title' => $request->title,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->keywords,
        ]);
        return redirect()->route('pages')->with('message', 'Pages added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page = Page::find($id);
        return view('admin.cms.pages.update', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $page = Page::find($id);
        $page->update([
            'name' => $request->name,
            'position' => $request->position,
            'slug' => Str::slug($request->name),
            'title' => $request->title,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->keywords,
        ]);
        return redirect()->route('pages')->with('message', 'Pages updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Page::destroy($id);
        return back()->with('message', 'Page removed successfully');
    }
    public function dashboard(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        if ($from_date && $to_date) {
            $products = Product::whereBetween('created_at', [$from_date, $to_date])->count();
            $newproducts = Product::whereBetween('created_at', [$from_date, $to_date])->where('is_new', true)->count();
            $featuredproducts = Product::whereBetween('created_at', [$from_date, $to_date])->where('is_new', true)->count();
            $categories = Category::whereBetween('created_at', [$from_date, $to_date])->count();
            $customers = Customer::whereBetween('created_at', [$from_date, $to_date])->count();
            $orders = Order::whereBetween('created_at', [$from_date, $to_date])->count();
            $pages = Page::whereBetween('created_at', [$from_date, $to_date])->count();
            $sliders = Slider::whereBetween('created_at', [$from_date, $to_date])->count();
            $banners = Banner::whereBetween('created_at', [$from_date, $to_date])->count();

            $completed = Order::whereBetween('created_at', [$from_date, $to_date])
                ->where('status', 'Shipped')->orWhere('status', 'completed')
                ->orWhere('status', 'Invoice Created')->sum('grand_total');
            $completed_tax = Order::whereBetween('created_at', [$from_date, $to_date])
                ->where('status', 'Shipped')->orWhere('status', 'completed')
                ->orWhere('status', 'Invoice Created')->sum('tax_total');

            $pending = Order::whereBetween('created_at', [$from_date, $to_date])
                ->Where('status', 'pending')->sum('grand_total');
            $pending_tax = Order::whereBetween('created_at', [$from_date, $to_date])
                ->Where('status', 'pending')->sum('tax_total');
            $reviews = Review::whereBetween('created_at', [$from_date, $to_date])->count();
            $subscribers = Newsletter::whereBetween('created_at', [$from_date, $to_date])->count();
            $invoices = Order::whereBetween('created_at', [$from_date, $to_date])->where('is_invoice_created', 1)->count();
            $shipped = Order::whereBetween('created_at', [$from_date, $to_date])->where('is_shipped', 1)->count();
            $refunds = Order::whereBetween('created_at', [$from_date, $to_date])->where('is_refunded', 1)->count();
            $applications = Career::whereBetween('created_at', [$from_date, $to_date])->count();
        } else {
            $products = Product::count();
            $newproducts = Product::where('is_new', true)->count();
            $featuredproducts = Product::where('is_featured', true)->count();
            $categories = Category::count();
            $customers = Customer::count();
            $orders = Order::count();
            $pages = Page::count();
            $sliders = Slider::count();
            $banners = Banner::count();

            $completed = Order::where('status', 'Shipped')->orWhere('status', 'completed')
                ->orWhere('status', 'Invoice Created')->sum('grand_total');
            $completed_tax = Order::where('status', 'Shipped')->orWhere('status', 'completed')
                ->orWhere('status', 'Invoice Created')->sum('tax_total');

            $pending = Order::Where('status', 'pending')->sum('grand_total');
            $pending_tax = Order::Where('status', 'pending')->sum('tax_total');
            $reviews = Review::whereBetween('created_at', [$from_date, $to_date])->count();
            $subscribers = Newsletter::count();
            $invoices = Order::where('is_invoice_created', 1)->count();
            $shipped = Order::where('is_shipped', 1)->count();
            $refunds = Order::where('is_refunded', 1)->count();
            $applications = Career::count();
        }
        return view('admin.dashboard', compact('products', 'categories', 'customers', 'orders', 'pages', 'sliders', 'banners', 'completed', 'completed_tax', 'pending', 'pending_tax', 'reviews', 'subscribers', 'invoices', 'shipped', 'refunds', 'newproducts', 'featuredproducts', 'applications'));
    }
}
