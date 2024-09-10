<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Http\Services\Helpers\Punjabi;
use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchColumns = ['id', 'title'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;
        $query = Slider::query();
        if ($search != '') {
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });
        }
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);
        $sliders = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.cms.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cms.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'position' => 'required',
            'position' => 'required',
            'slider' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $slider = new Slider();
            $slider->title = $request->title;
            $slider->url = $request->url;
            $slider->position = $request->position;
            $slider_image = $request->file('slider')->store('slider', 'public');
            $slider->slider_path = "storage/" . $slider_image;
            $slider->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect()->route('sliders')->with('success', 'Slider successfully added!');
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
        $slider = Slider::find($id);
        return view('admin.cms.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = Slider::find($id);
        DB::beginTransaction();
        try {
            if ($request->hasFile('slider')) {
                $slider_image = '';
                $slider_image = $request->file('slider')->store('slider', 'public');
                $slider_image = 'storage/' . $slider_image;
            } else {
                $slider_image = $slider->slider_path;
            }
            $slider->update([
                'title' => $request->title,
                'url' => $request->url,
                'position' => $request->position,
                'slider_path' => $slider_image,
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect()->route('sliders')->with('success', 'Slider successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::find($id);
        if (!is_null($slider->image)) {
            Punjabi::deleteFile($slider->image->url);
        }
        $slider->delete();
        return back()->with('success', 'Slider deleted successfully');
    }
}
