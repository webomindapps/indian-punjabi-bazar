@props(['product'])
@props(['mode'])

@php
    $special = false;
    $today = date('Y-m-d');
    if ($product->special_price_from) {
        if ($product->special_price_from <= $today && $product->special_price_to >= $today) {
            $special = true;
        }
    }
@endphp
@if (isset($mode))
    <div class="grid_product mb-3 pb-3">
        <div class="row">
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <a href="{{ route('productByCategory', $product->url_key) }}">
                            <div class="grid_image position-relative">
                                @if (count($product->images))
                                    <img src="{{ asset($product?->images[0]->image_url) }}" class="img-fluid">
                                @else
                                    <img src="{{ asset('frontend/assets/images/default.png') }}" class="img-fluid">
                                @endif

                                @if ($special)
                                    <span class="onsale">Sale!</span>
                                @endif
                            </div>
                        </a>

                    </div>
                    <div class="col-lg-8 col-md-7 my-auto">
                        <div class="grid_product_desc prd-desc">

                            <span class="d-block prd-name mb-2">
                                <a href="{{ route('productByCategory', $product->url_key) }}">
                                    {{ $product->name }}
                                </a>
                            </span>
                            @if ($product->inventory->inventory > 0 && $product->in_stock)
                                <span class="stock green text-center">Available in stock</span>
                            @else
                                <span class="stock red text-center">Out of stock</span>
                            @endif

                        </div>
                        <div class="product_grid_pricing d-flex">
                            <p class="pe-2 mb-1" style="color: green">Price</p>
                            @if ($special)
                                <del>${{ number_format($product->price ?? 0, 2) }}</del>
                                <span class="price">${{ number_format($product->special_price ?? 0, 2) }}</span>
                            @else
                                <span class="price">${{ number_format($product->price ?? 0, 2) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3    my-auto">
                <div class="row mt-lg-3">
                    <p class="mb-1">Quantity</p>
                    <x-products.qty :id="$product->id" />
                    <div class="add_inner">
                        @if ($product->inventory->inventory > 0 && $product->in_stock)
                            <a class="add_to_cart addToCart d-inline-block py-2 px-4" data-id="{{ $product->id }}">
                                <i class='bx bx-cart-add pe-2'></i> Add
                            </a>
                        @else
                            <a class="add_to_cart bg-danger text-white d-inline-block py-2 px-4"
                                data-id="{{ $product->id }}">
                                Out Of Stock
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@else
    {{-- <div class="item">
        <div class="prd-box">
            <a href="{{ route('productByCategory', $product->url_key) }}">
                <span class="prd-img">
                    @if (count($product->images))
                        <img src="{{ asset($product?->images[0]->image_url) }}" class="img-fluid w-100">
                    @else
                        <img src="{{ asset('frontend/assets/images/default.png') }}" class="img-fluid w-100">
                    @endif
                </span>
            </a>
            <div class="prd-desc">
                @if ($special)
                    <span class="onsale">Sale!</span>
                @endif
                <span class="d-block prd-name">
                    <a href="{{ route('productByCategory', $product->url_key) }}">{{ $product->name }}</a>
                </span>
                <div class="d-flex justify-content-between">
                    <span class="price">
                        @if ($special)
                            <del>${{ number_format($product->price ?? 0, 2) }}</del>
                            ${{ number_format($product->special_price ?? 0, 2) }}
                        @else
                            ${{ number_format($product->price ?? 0, 2) }}
                        @endif
                    </span>
                    <div class="justify-content-end">
                        <x-products.qty :id="$product->id" />
                    </div>
                </div>
                <span class="d-block prd-name">
                    @if ($product->inventory->inventory > 0 && $product->in_stock)
                        <a class="add_to_cart addToCart" data-id="{{ $product->id }}">
                            <i class='bx bx-cart-add'></i> Add
                        </a>
                    @else
                        <a class="add_to_cart bg-danger text-white" data-id="{{ $product->id }}">
                            Out Of Stock
                        </a>
                    @endif
                </span>

            </div>
        </div>
    </div> --}}
    <div class="item">
        <div class="prd-box">

            <span class="whis"><a style="min-width: 0" class="addToWishlist" data-id="{{ $product->id }}"
                    href="{{ route('add-to-wishlist', $product->id) }}">
                    <i style="font-size: 23px;" class='bx bx-heart'></i>
                </a></span>
            <a href="{{ route('productByCategory', $product->url_key) }}">
                <span class="prd-img">
                    @if (count($product->images))
                        <img src="{{ asset($product?->images[0]->image_url) }}" class="img-fluid ">
                    @else
                        <img src="{{ asset('frontend/assets/images/default.png') }}" class="img-fluid ">
                    @endif
                </span>
            </a>
            <div class="prd-desc">
                @if ($special)
                    <span class="onsale">Sale!</span>
                @endif
                <span class="d-block prd-name">
                    <a href="{{ route('productByCategory', $product->url_key) }}">{{ $product->name }}</a>
                </span>
                {{-- <span class="d-block prd-name"><a href="#">Organic Grapes</a></span> --}}
                {{-- <span class="stock green text-center">Available in stock</span> --}}

                @if ($product->inventory->inventory > 0 && $product->in_stock)
                    <span class="stock green text-center">Available in stock</span>
                @else
                    <span class="stock red text-center">Out of stock</span>
                @endif

                <span class="price">
                    @if ($special)
                        <del>${{ number_format($product->price ?? 0, 2) }}</del>
                        ${{ number_format($product->special_price ?? 0, 2) }}
                    @else
                        ${{ number_format($product->price ?? 0, 2) }}
                    @endif
                </span>
                <div class="product_option">
                    <div class="inputs-group button-group">
                        <div class="input-group">
                            <x-products.qty :id="$product->id" />
                        </div>
                    </div>
                    @if ($product->inventory->inventory > 0 && $product->in_stock)
                        <a class="add_to_cart addToCart" data-id="{{ $product->id }}">
                            <i class='bx bx-cart-add'></i>
                        </a>
                    @else
                        <a class="add_to_cart bg-danger text-white" data-id="{{ $product->id }}">
                            Out
                        </a>
                    @endif

                </div>
                <a class="add_to_cart addToCart" data-id="{{ $product->id }}">
                    <i class='bx bx-cart-add'></i> Add
                </a>
            </div>
        </div>
    </div>
@endif
