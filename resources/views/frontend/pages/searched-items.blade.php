<div class="">
    @if (is_null($products) || count($products) == 0)
        <p class="text-center mb-0">No Result Found</p>
    @else
        @foreach ($products as $product)
            <li>
                <div class="row align-items-center">
                    <div class="col-lg-1 col-3">
                        @if (count($product->images))
                            <img src="{{ asset($product->images[0]->image_url) }}" loading="lazy" alt="product"
                                class="img-fluid img-responsive">
                        @else
                            <img src="{{ asset('frontend/assets/images/default.png') }}" loading="lazy" alt="product"
                                class="img-fluid img-responsive">
                        @endif
                    </div>
                    <div class="col-lg-3 col-6">
                        <a href="{{ route('productByCategory', $product->url_key) }}">
                            <div class="pct-desc">
                                <p>
                                    {{ $product->name }}
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-3 text-center text-lowercase">
                         {{ $product->weight }} <span>{{ $product->weight_type }}</span>
                    </div>
                    <div class="col-lg-1 col-3 text-center">
                        <div class="search-price">$ {{ $product->price }}</div>
                    </div>
                    <div class="col-lg-3 col-5 text-center">
                        <div class="quantity">
                            <div class="input-group-btn qtyDecrement" data-id="{{ $product->id }}">
                                <span class="quantity-btn quantity-minus">
                                    <i class='bx bx-minus' aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="number" id="quantity-{{ $product->id }}"
                                class="input-text qty text quantity-{{ $product->id }}" step="1" name="quantity"
                                name="" value="1" title="Qty" placeholder="" inputmode="numeric">
                            <div class="input-group-btn qtyIncrement" data-id="{{ $product->id }}">
                                <span class="quantity-btn quantity-plus">
                                    <i class='bx bx-plus' aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2  col-4 text-center my-auto">
                        @if ($product->inventory->inventory > 0 && $product->in_stock)
                            <a class="search-btn-cart addToCart" data-id="{{ $product->id }}">
                                Cart <i class='bx bx-cart-alt'></i>
                            </a>
                        @else
                            <a class="search-btn-cart bg-danger">
                                <i class='bx bx-message-square-x'></i>
                            </a>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    @endif
</div>
