<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryCity;
use Illuminate\Http\Request;

class DeliveryCityController extends Controller
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
        $query = DeliveryCity::query();
        if ($search != '') {
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });
        }
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);
        $deliveryCities = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.delivery-city.index', compact('deliveryCities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.delivery-city.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'city'                 => 'required',
            'delivery_price'       => 'required',
            'min_amt_for_shipping' => 'required',
        ]);
        DeliveryCity::create($request->all());
        return redirect()->route('delivery.cities')->with('message', 'Delivery city added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $deliveryCity = DeliveryCity::find($id);
        return view('admin.delivery-city.update', compact('deliveryCity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'city'                 => 'required',
            'delivery_price'       => 'required',
            'min_amt_for_shipping' => 'required',
        ]);
        $deliveryCity = DeliveryCity::find($id);
        $deliveryCity->update([
            'city' => $request->city,
            'delivery_price' => $request->delivery_price,
            'min_amt_for_shipping' => $request->min_amt_for_shipping,
        ]);
        return redirect()->route('delivery.cities')->with('message', 'Delivery city updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DeliveryCity::destroy($id);
        return back()->with('message', 'Delivery city deleted successfully');
    }
    public function deleteSelected(Request $request)
    {
        DeliveryCity::whereIn('id', $request->ids)->delete();
        return response()->json(['message' => 'Delivery city deleted successfully']);
    }
    public function bulkStsChng(Request $request)
    {
        $ids = $request->ids;
        for ($i = 0; $i < count($ids); $i++) {
            $deliveryCity = DeliveryCity::find($ids[$i]);
            $deliveryCity->update(['status' => $request->status]);
        }
    }
}
