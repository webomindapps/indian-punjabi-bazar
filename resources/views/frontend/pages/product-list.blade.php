@if (isset($category))
    @section('metaTitle', $category->getMetaTags()['title'])
    @section('metaDescription', $category->getMetaTags()['description'])
    @section('metaKeywords', $category->getMetaTags()['keywords'])
@endif
<x-app-layout>
    <div class="content mt-4 list_page ">
        <div class="container mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">Products</li>
                    @if (isset($category))
                        <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                    @endif
                    @if (request()->is_best_seller == '1')
                        <li class="breadcrumb-item active" aria-current="page">Best Sellers</li>
                    @endif
                    @if (request()->is_new == '1')
                        <li class="breadcrumb-item active" aria-current="page">New Arrivals</li>
                    @endif
                </ol>
            </nav>
        </div>
        <div class="container secs listing_wrapper">
            <div class="col-12 d-flex">
                {{-- filter here --}}
                <x-product-filter :subcategories="$sub_categories" />
                <div class="products_list_box">
                    @if (count($products) == 0)
                        <p class="text-center">No Products found with these details</p>
                    @endif
                    @if (request()->mode == 'list')
                        <div class="grid_view">
                            <div class="col-12">
                                @foreach ($products as $product)
                                    <x-products.card :mode="request()->mode" :product="$product" />
                                @endforeach
                            </div>
                        </div>
                    @else
                        @foreach ($products as $product)
                            <x-products.card :product="$product" />
                        @endforeach
                        <div class="item empty"></div>
                        <div class="item empty"></div>
                        <div class="item empty"></div>
                        <div class="item empty"></div>
                        <div class="item empty"></div>
                    @endif
                </div>
            </div>
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>
