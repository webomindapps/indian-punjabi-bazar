<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        Review::create([
            'customer_id' => auth('customer')->user()->id,
            'product_id' => $request->product_id,
            'rating' => $request->rating ?? 0,
            'title' => $request->title,
            'description' => $request->comment,
        ]);
        return back()->with('message', 'Product review submitted successfully');
    }
    public function index()
    {
        $reviews = Review::paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }
    public function edit($id)
    {
        $review = Review::find($id);
        return view('admin.reviews.edit', compact('review'));
    }
    public function update(Request $request, $id)
    {
        $review = Review::find($id);
        $review->update([
            'status' => $request->status
        ]);
        return redirect()->route('reviews')->with('message', 'Review updated successfully');
    }

    public function destroy($id)
    {
        Review::destroy($id);
        return back()->with('message', 'Review deleted  successfully');
    }
    public function deleteSelected(Request $request)
    {
        Review::whereIn('id', $request->ids)->delete();
        return response()->json(['message' => 'Delivery city deleted successfully']);
    }
    public function bulkStsChng(Request $request)
    {
        $ids = $request->ids;
        for ($i = 0; $i < count($ids); $i++) {
            $review = Review::find($ids[$i]);
            $review->update(['status' => $request->status]);
        }
    }
}
