<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CategoryExport;
use App\Http\Controllers\Controller;
use App\Http\Services\Helpers\Punjabi;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function model()
    {
        return new Category;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchColumns = ['id', 'name', 'position', 'slug'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;

        $query = $this->model()->with('image');

        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $categories = $paginate ? $query->tree()->paginate($paginate)->appends(request()->query()) : $query->tree()->paginate(10)->appends(request()->query());
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1);
        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'slug' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $data = $request->all();
            $slug = Str::slug($request->name);
            $data['slug'] = $slug;

            if ($request->hasFile('icon')) {
                $folder = 'categories/icons/';
                $iconPath = $request->file('icon')->store($folder, 'public');
                $data['icon'] = $iconPath;
            }

            $category = $this->model()->create($data);

            //uploading category images
            if ($request->hasFile('image')) {
                $folder = 'categories/' . $category->id;
                $imagePath = $request->file('image')->store($folder, 'public');
                $category->image()->create(['path' => $imagePath]);
            }

            //add meta tag details
            $data = [
                'title' => $request->meta_title,
                'description' => $request->meta_description,
                'keywords' => $request->keywords,
            ];
            $category->metatag()->create($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect()->route('categories')->with('success', 'Category added successfully');
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
        $category = Category::find($id);
        $categories = Category::where('status', 1);
        return view('admin.category.update', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $slug = Str::slug($request->name);
            $data['slug'] = $slug;
            $category = Category::find($id);
            if ($request->hasFile('icon')) {
                $folder = 'categories/icons/';
                $iconPath = $request->file('icon')->store($folder, 'public');
                $data['icon'] = $iconPath;
            } else {
                $data['icon'] = $category->getRawOriginal('icon');
            }
            $category->update($data);

            //uploading category icons
            if ($request->hasFile('image')) {
                $folder = 'categories/' . $category->id;
                $path = $request->file('image')->store($folder, 'public');

                if (is_null($category->image)) {
                    $category->image()->create(['path' => $path]);
                } else {
                    //delete existing image
                    Punjabi::deleteFile($category->image->path);
                    $category->image()->update(['path' => $path]);
                }
            }
            //add meta tag details
            $category->metatag()->update([
                'title' => $request->meta_title,
                'description' => $request->meta_description,
                'keywords' => $request->keywords
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect()->route('categories')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        //delete image from folder
        if (!is_null($category->image)) {
            Punjabi::deleteFile($category->image->url);
        }
        $category->delete();
        return back()->with('success', 'Category deleted successfully');
    }
    public function export()
    {
        return Excel::download(new CategoryExport, 'categories.xlsx');
    }
    public function deleteSelected(Request $request)
    {
        Category::whereIn('id', $request->ids)->delete();
        return response()->json(['message' => 'Categories deleted successfully']);
    }
    public function bulkStsChng(Request $request)
    {
        $ids = $request->ids;
        for ($i = 0; $i < count($ids); $i++) {
            $category = Category::find($ids[$i]);
            $category->update(['status' => $request->status]);
        }
    }
}
