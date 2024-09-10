<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Helpers\Punjabi;
use App\Models\HomeSetting;
use Illuminate\Http\Request;

class HomeSettingController extends Controller
{
    public function index()
    {
        $setting = HomeSetting::first();
        return view('admin.homesetting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = HomeSetting::first();
        $path = $setting->logo;
        if ($request->hasFile('logo')) {
            $folder = 'logo';
            $path = Punjabi::upload($request->logo, $folder);
            $path = 'storage/' . $path;
        }
        $setting->update([
            'name' => $request->name,
            'contact_email' => $request->contact_email,
            'admin_mails' => $request->admin_mails,
            'logo' => $path,
            'address' => $request->address,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'map_location' => $request->map_location,
            'working_hours' => $request->working_hours,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'keywords' => $request->keywords,
        ]);
        return back()->with('message', 'Home Setting  updated successfully');
    }
}
