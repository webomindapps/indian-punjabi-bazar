<div class="container secs p-0 category">
    <div class="cat_wrapper">
        <h2 class="sec_title">Shop By Category</h2>
        <div class="owl-carousel owl-theme owl-one">
            @foreach ($top_categories as $category)
                <div class="item">
                    <div class="cat-box" style="--bg-color: #fef1e6;">
                        <a href="{{ route('productByCategory', $category->slug) }}">
                            <span class="category-icon">
                                <img src="{{ asset($category->getImage() ?? 'frontend/assets/images/offer-banner.png') }}"
                                    alt="" class="img-fluid ">
                            </span>
                            <span class="d-block catgory-name">

                                {{ $category->name }}
                            </span>

                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
