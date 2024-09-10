<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variant;
use App\Models\VariantValue;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function index()
    {
        $variants = Variant::all();
        return view('admin.variant.index', compact('variants'));
    }

    public function store(Request $request)
    {
        $variants = $request->variants;
        $variants_id = $request->variant_id;

        //delete the variants from db
        $deleted_ids = explode(",", $request->deleted_ids);
        // dd($request->deleted_ids);
        foreach ($deleted_ids as $id) {
            if ($id != '') {
                $variant = Variant::find($id);
                if (!is_null($id)) {
                    $variant->delete();
                }
            }
        }

        //add or update the variants 
        if (!is_null($variants_id)) {
            foreach ($variants_id as $key => $var_id) {
                if (is_null($var_id)) {
                    $variant = Variant::create(['name' => $variants[$key]]);
                } else {
                    $variant = Variant::find($var_id);
                    $variant->update(['name' => $variants[$key]]);
                }
            }
        }
        return redirect()->route('variants')->with('success', 'Variant added successfully');
    }


    public function variantValue()
    {
        $variant_values = VariantValue::all();
        return view('admin.variant.variant-value', compact('variant_values'));
    }

    public function variantValueStore(Request $request)
    {
        $names = $request->names;
        $values = $request->values;
        $variant_ids = $request->variant_ids;
        $values_id = $request->value_id;
        $deleted_ids = $request->deleted_values_ids;

        //delete the variants from db
        foreach (explode(",", $deleted_ids) as $id) {
            if ($id != '') {
                $variant_value = VariantValue::findOrFail($id);
                if (!is_null($id)) {
                    $variant_value->delete();
                }
            }
        }

        //add or update the variants 
        if (!is_null($values_id)) {
            foreach ($values_id as $key => $var_id) {
                if (is_null($var_id)) {
                    $variant = VariantValue::create([
                        'variant_id' => $variant_ids[$key],
                        'name' => $names[$key],
                        'value' => $values[$key]
                    ]);
                } else {
                    $variant = VariantValue::find($var_id);
                    $variant->update([
                        'variant_id' => $variant_ids[$key],
                        'name' => $names[$key],
                        'value' => $values[$key]
                    ]);
                }
            }
        }
        return redirect()->route('variant.value.index')->with('success', 'Variant added successfully');
    }
}
