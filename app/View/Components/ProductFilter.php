<?php

namespace App\View\Components;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Flavour;
use App\Models\ProductForm;
use App\Models\ProductSource;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductFilter extends Component
{
    /**
     * Create a new component instance.
     */
    public $categories;
    public $brands;
    public $flavours;
    public $sources;
    public $forms;
    public function __construct()
    {
        $this->brands = Brand::where('status', 1)->orderBy('name','asc')->get();
        $this->flavours = Flavour::orderBy('flavour','asc')->get();
        $this->sources = ProductSource::orderBy('source','asc')->get();
        $this->forms = ProductForm::orderBy('form','asc')->get();
        $this->categories = Category::where('status', 1)->whereNull('parent_id')->orderBy('name','asc')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-filter');
    }
}
