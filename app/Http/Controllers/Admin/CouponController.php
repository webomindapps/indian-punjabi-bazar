<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Coupon;
    }
    public function index()
    {
        $searchColumns = ['id', 'name', 'coupon', 'from', 'to'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;

        $query = $this->model->query();

        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $coupons = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());

        return view('admin.coupons.index', compact('coupons'));
    }
    public function create()
    {
        return view('admin.coupons.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:coupons',
            'from' => 'required',
            'to' => 'required',
            'discount_type' => 'required',
            'discount_type_value' => 'required',
            'min_amount_for_discount' => 'required',
            'max_discount_amount' => 'required',
        ]);
        $this->model->create($request->all());
        return redirect()->route('coupons')->with('success', 'Coupon added successfully');
    }
    public function edit($id)
    {
        $coupon = $this->model->find($id);
        return view('admin.coupons.update', compact('coupon'));
    }
    public function update(Request $request, $id)
    {
        $coupon = $this->model->find($id);
        $coupon->update($request->all());
        return redirect()->route('coupons')->with('success', 'Coupon updated successfully');
    }
    public function destroy($id)
    {
        $this->model->destroy($id);
        return back()->with('success', 'Coupon deleted successfully');
    }
}
