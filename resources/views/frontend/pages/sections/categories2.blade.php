<div class="container secs category">
    <h2 class="sec_title">Categories</h2>
    <div class="owl-carousel owl-theme owl-one">
        @foreach ($top_categories as $category)
            <div class="item">
                <a href="{{ route('productByCategory', $category->slug) }}">
                    <div class="cat-box" style="--bg-color: #fef1e6;">
                        <span class="category-icon">
                            <img src="{{ asset($category->icon) }}" class="img-fluid">
                        </span>
                        <span class="d-block catgory-name">
                            {{ $category->name }}
                        </span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
