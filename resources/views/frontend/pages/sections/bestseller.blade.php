<div class="container bg-white secs products">
    <div class="with_btn">
        <h2 class="sec_title">Best Sellers</h2>
        <div class="btn_wrapper text-center">
            <a href="{{ route('productByCategory', 'categorysearch') }}?is_best_seller=1" class="view-all">View All
                Products <i class='bx bx-right-arrow-alt'></i></a>
        </div>
    </div>
    <div class="owl-carousel owl-theme owl-two">
        @foreach ($best_sellers as $product)
            <x-products.card :product="$product" />
        @endforeach
    </div>

</div>
