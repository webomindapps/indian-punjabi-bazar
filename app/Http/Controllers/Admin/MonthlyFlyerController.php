<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Helpers\Punjabi;
use App\Models\MonthlyFlyer;
use Illuminate\Http\Request;

class MonthlyFlyerController extends Controller
{
    public function index()
    {
        $flyer = MonthlyFlyer::first();
        return view('admin.monthlyflyer.index', compact('flyer'));
    }
    public function store(Request $request)
    {
        $flyer = MonthlyFlyer::first();
        $path = $flyer?->file;
        if ($request->hasFile('file')) {
            $folder = 'monthly-flyer';
            $path = Punjabi::upload($request->file, $folder);
            $path = 'storage/' . $path;
        }
        if (is_null($flyer)) {
            $flyer = MonthlyFlyer::create([
                'title' => $request->title,
                'file'  => $path
            ]);
        } else {
            $flyer->update([
                'title' => $request->title,
                'file' => $path,
            ]);
        }
        return redirect()->route('monthlyflyer')->with('message', 'Flyer added successfully');
    }
}
