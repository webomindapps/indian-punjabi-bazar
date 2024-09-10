<x-app-layout>
    <div class="content mt-4 detail_page ">
        <div class="container mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Health Goals And Concerns</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container secs healthy">
        <div class="row g-3">
            @foreach ($categories as $category)
                <div class="col-lg-2 col-md-3 col-4">
                    <div class="item">
                        <a href="{{ route('productByCategory', $category->slug) }}">
                            <div class="col text-center" style="--bg-color: #f5fdfa">
                                <img src="{{ asset($category->getImage() ?? 'frontend/assets/images/default.png') }}"
                                    alt="" class="img-fluid circle mx-auto">
                                <h3>{{ $category->name }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
