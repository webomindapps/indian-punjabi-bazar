<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Helpers\Punjabi;
use App\Mail\ProductRequestMail;
use App\Models\HomeSetting;
use App\Models\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductRequestController extends Controller
{
    public function create()
    {
        return view('frontend.pages.product-request');
    }
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'phone'      => 'required',
            'brand'      => 'required',
            'product'    => 'required',
        ]);
        $image = '';
        if ($request->hasFile('image')) {
            $folder = 'product-request-image';
            $image = Punjabi::upload($request->image, $folder);
            $image = 'storage/' . $image;
        }

        $prequest = ProductRequest::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'product_name'  => $request->product,
            'brand'         => $request->brand,
            'image'         => $image,
            'message'       => $request->message,
        ]);
        $setting = HomeSetting::latest()->first();
        $emails = explode(',', $setting->admin_mails);
        if ($emails) {
            Mail::to($emails)->send(new ProductRequestMail($prequest));
        }

        return back()->with('message', 'We will get you soon');
    }

    public function index()
    {
        $searchColumns = ['id', 'first_name', 'last_name', 'email', 'phone'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;
        $query = ProductRequest::query();
        if ($search != '') {
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });
        }
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);
        $requests = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.requests.index', compact('requests'));
    }

    public function show($id)
    {
        $prequest = ProductRequest::find($id);
        return view('admin.requests.show', compact('prequest'));
    }

    public function destroy($id)
    {
        ProductRequest::destroy($id);
        return back()->with('message', 'deleted successfully');
    }
}
