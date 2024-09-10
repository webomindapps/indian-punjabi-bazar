<x-app-layout>
    <div class="content mt-4 detail_page ">
        <div class="container mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Brands</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container secs">
        <div class="row pb-5 g-3">
            @foreach ($brands as $brand)
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('productByCategory', 'productsbyBrand') }}?brand={{ $brand->id }}">
                        <div class="border rounded p-2 d-flex flex-column align-items-center">
                            <img src="{{ asset($brand->image) }}" alt="" class="img-fluid mx-auto"
                                style="height: 50px;">
                            <p class="mt-1 mb-0 text-capitalize fw-bold">{{ $brand->name }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
