<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = [
            'type_1' => Banner::where('type', 1)->orderBy('position', 'asc')->get(),
            'type_2' => Banner::where('type', 2)->orderBy('position', 'asc')->get(),
            'type_3' => Banner::where('type', 3)->orderBy('position', 'asc')->get(),
        ];
        return view('admin.cms.banner.index', compact('banners'));
    }
    public function create()
    {
        $type = request()->type;
        return view('admin.cms.banner.create', compact('type'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'position' => 'required',
            'banner' => 'required'
        ]);
        $banner_image = $request->file('banner')->store('banners', 'public');

        $banner = new Banner();
        $banner->title = $request->title;
        $banner->type = $request->type;
        $banner->url = $request->url;
        $banner->position = $request->position;
        $banner->banner_image_path = $banner_image;
        $banner->save();

        return redirect()->route('banners')->with('success', 'Banner successfully added!');
    }
    public function destroy($id)
    {
        $banner = Banner::find($id);

        $banner->delete();

        return back()->with('success', 'Banner deleted successfully!');
    }
}
