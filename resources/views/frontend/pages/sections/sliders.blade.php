<div class="container w-100 mx-100">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div id="banner" class="owl-carousel owl-theme">
                    @foreach ($sliders as $slider)
                        <div class="item">
                            <div class="banner">
                                <a href="{{ $slider->url }}">
                                    <img src="{{ asset($slider->slider_path) }}" alt=""
                                        class="img-fluid rounded d-block w-100">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($sliders as $slider)
                            <div class="carousel-item {{ $loop->first ? 'active carousel-item-start' : '' }}">
                                <img src="{{ asset($slider->slider_path) }}" alt=""
                                    class="img-fluid rounded d-block w-100">
                            </div>
                        @endforeach
                        <div class="carousel-item carousel-item-next carousel-item-start">
                            <img src="https://img.freepik.com/premium-vector/elegant-face-cream-banner_317442-642.jpg?w=2000"
                                alt="" class="d-block img-fluid rounded">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div> --}}
            </div>
        </div>
    </div>
</div>
