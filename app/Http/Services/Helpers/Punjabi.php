<?php

namespace App\Http\Services\Helpers;

use App\Models\Page;
use App\Models\Banner;
use App\Models\Variant;
use App\Models\Category;
use App\Models\HomeSetting;
use App\Models\MonthlyFlyer;

class Punjabi
{

    public static function getStatus()
    {
        return [
            ['label' => 'Active', 'value' => 1],
            ['label' => 'In-Active', 'value' => 0],
        ];
    }

    public static function upload($file, $folder)
    {
        return $file->store($folder, 'public');
    }

    public static function deleteFile($path, $storage = true)
    {
        $file = storage_path('app/public/' . $path);
        if (file_exists($file)) {
            // unlink($file);
        }
        return true;
    }

    public static function getAllCategories()
    {
        $categories = Category::where('status', 1)->tree()->get()->toTree();
        return $categories;
    }

    public static function variants()
    {
        return Variant::with('values')->get();
    }

    public static function flyer()
    {
        return MonthlyFlyer::first();
    }

    public static function pages()
    {
        return Page::orderBy('position', 'asc')->get();
    }
    public static function settings()
    {
        return HomeSetting::first();
    }
    public static function topCategories()
    {
        return Category::where('status', 1)->whereNull('parent_id')->orderBy('position')->limit(5)->get();
    }

    // public static function getBanners()
    // {
    //     return [
    //         'one' => Banner::where('type', 1)->get()->map(function ($item) {
    //             return [asset('storage/' . $item->banner_image_path)];
    //         }),
    //         'two' => Banner::where('type', 2)->get()->map(function ($item) {
    //             return [asset('storage/' . $item->banner_image_path)];
    //         }),
    //         'three' => Banner::where('type', 3)->get()->map(function ($item) {
    //             return [asset('storage/' . $item->banner_image_path)];
    //         })
    //     ];
    // }

    // public static function getFooterPages()
    // {
    //     return Page::orderBy('position', 'asc')->get();
    // }
}
