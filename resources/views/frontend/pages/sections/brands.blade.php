<div class="container secs brands">
    <h2 class="sec_title">Brands</h2>
    <div class="owl-carousel owl-theme owl-one">
        @foreach ($brands as $brand)
            <div class="item">
                <a href="{{ route('productByCategory', 'productsbyBrand') }}?brand={{ $brand->id }}">
                    <img src="{{ asset($brand->image) }}" alt="" class="img-fluid">
                </a>
            </div>
        @endforeach
    </div>
</div>
