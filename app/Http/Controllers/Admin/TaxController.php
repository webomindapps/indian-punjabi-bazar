<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $searchColumns = ['id', 'title','percent'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;
        $query = Tax::query();
        if ($search != '') {
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });
        }
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);
        $taxes = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.tax.index', compact('taxes'));
    }
    public function create()
    {
        return view('admin.tax.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required',
            'percent' => 'required'
        ]);
        Tax::create([
            'title'       => $request->title,
            'percent'     => $request->percent,
            'status'      => $request->status,
            'description' => $request->description,
        ]);
        return redirect()->route('taxes')->with('message', 'Tax added successfully');
    }

    public function edit($id)
    {
        $tax = Tax::find($id);
        return view('admin.tax.edit', compact('tax'));
    }

    public function update(Request $request, $id)
    {
        $tax = Tax::find($id);
        $tax->update([
            'title'      => $request->title,
            'percent'    => $request->percent,
            'status'     => $request->status,
            'description' => $request->description
        ]);
        return redirect()->route('taxes')->with('Updated successfully');
    }

    public function destroy($id)
    {
        Tax::destroy($id);
        return back()->with('message', 'Tax removed successfully');
    }

    public function deleteSelected(Request $request)
    {
        Tax::whereIn('id', $request->ids)->delete();
        return response()->json(['message' => 'Taxes deleted successfully']);
    }
    public function bulkStsChng(Request $request)
    {
        $ids = $request->ids;
        for ($i = 0; $i < count($ids); $i++) {
            $tax = TAx::find($ids[$i]);
            $tax->update(['status' => $request->status]);
        }
    }
}
