<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Helpers\Punjabi;
use App\Models\Brand;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchColumns = ['id', 'name'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;
        $query = Brand::query();
        if ($search != '') {
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });
        }
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);
        $brands = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            //uploading brand image
            if ($request->hasFile('image')) {
                $folder = 'brands';
                $path = Punjabi::upload($request->image, $folder);
                $path = 'storage/' . $path;
            }
            Brand::create([
                'name' => $request->name,
                'image' => $path,
            ]);
            //add meta tag details
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect()->route('brands')->with('success', 'Brand addded successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('admin.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.update', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $brand = Brand::find($id);
        $path = $brand->image;
        try {
            //uploading brand image
            if ($request->hasFile('image')) {
                $folder = 'brands';
                $path = Punjabi::upload($request->image, $folder);
                $path = 'storage/' . $path;
            }
            $brand->update([
                'name' => $request->name,
                'status' => $request->status,
                'image' => $path,
            ]);
            //add meta tag details
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect()->route('brands')->with('message', 'Brand updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Brand::destroy($id);
        return back()->with('message', 'Brand deleted successfully');
    }
}
