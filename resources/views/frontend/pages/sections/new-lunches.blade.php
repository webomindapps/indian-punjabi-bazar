{{-- <div class="container secs products">
    <h2 class="sec_title">New Arrivals</h2>
    <div class="owl-carousel owl-theme owl-two">
        @foreach ($new_launches as $item)
            <x-products.card :product="$item" />
        @endforeach
    </div>
    <div class="btn_wrapper text-center">
        <a href="{{ route('productByCategory', 'categorysearch') }}?is_new=1" class="view-all">View All Products <i
                class='bx bx-right-arrow-alt'></i></a>
    </div>
</div> --}}

<div class="container secs pt-0 products">
    <div class="col-12">
        <div class="row">
            <div class="col-md-3  pe-0">
                <div class="bg-maroon h-100 border-end-dark rounded">
                    <h2 class="sec_title pt-4 text-center text-white">Weekly Specials</h2>
                    <div class="owl-carousel bg-maroon owl-theme owl-four p-0">
                        {{-- <div class="prd-box">
                            <span class="whis"><i class='bx bx-heart'></i></span>
                            <span class="prd-img">
                                <img src="https://wpthemes.themehunk.com/openshop-grocery-store/wp-content/uploads/sites/121/2020/06/organicc-grapes.png"
                                    class="img-fluid">
                            </span>
                            <div class="prd-desc">
                                <span class="d-block prd-name"><a href="#">Organic Grapes</a></span>
                                <span class="stock green text-center">Available in stock</span>
                                <span class="price"><del>$105</del> $95</span>
                                <div class="product_option">
                                    <div class="inputs-group button-group">
                                        <div class="input-group">
                                            <input type="button" value="-" class="button-minus"
                                                data-field="quantity">
                                            <input type="text" step="1" max="" value="1"
                                                name="quantity" class="quantity-field">
                                            <input type="button" value="+" class="button-plus"
                                                data-field="quantity">
                                        </div>
                                    </div>
                                    <a href="#" class="add_inner"><i class='bx bx-cart-add'></i></a>
                                </div>

                                <a href="#" class="add_to_cart"><i class='bx bx-cart-add'></i> Add to
                                    cart</a>
                            </div>
                        </div> --}}
                        @foreach ($new_launches as $item)
                            <x-products.card :product="$item" />
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-9 bg-white new_arrival">
                <div class="with_btn">
                    <h2 class="sec_title mt-4 ms-3">New Arrivals</h2>
                    <div class="btn_wrapper text-center">
                        <a href="{{ route('productByCategory', 'categorysearch') }}?is_new=1" class="view-all">View All
                            Products <i class='bx bx-right-arrow-alt'></i></a>
                    </div>
                </div>
                <div class="owl-carousel owl-theme owl-three">

                    @foreach ($new_launches as $item)
                        <x-products.card :product="$item" />
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
