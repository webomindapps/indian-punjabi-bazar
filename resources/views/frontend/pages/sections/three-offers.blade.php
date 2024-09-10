<div class="secs container">
    <div class="col-12">
        <div class="row">
            @foreach ($offers as $offer)
                <div class="col-md-4">
                    <div class="offer-box relative rounded">
                        <img src="{{ asset('storage/'. $offer->banner_image_path) }}" alt="" class="img-fluid">
                        <a href="{{ $offer->url }}" class="shop-btn float-end">Shop Now</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
