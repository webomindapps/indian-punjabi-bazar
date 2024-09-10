@section('metaTitle', $product->getMetaTags()['title'])
@section('metaDescription', $product->getMetaTags()['description'])
@section('metaKeywords', $product->getMetaTags()['keywords'])
<x-app-layout>
    @php
        $special = false;
        $today = date('Y-m-d');
        if ($product->special_price_from) {
            if ($product->special_price_from <= $today && $product->special_price_to >= $today) {
                $special = true;
            }
        }
    @endphp
    <div class="content mt-4 detail_page ">
        <div class="container mt-3">
            <nav aria-label="breadcrumb">
                <div class="row">
                    <div class="col-lg-11 px-4 mx-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                        </ol>
                    </div>
                </div>
            </nav>
        </div>

        <div class="container secs pt-0">
            <div class="row px-lg-5">
                <div class="product_preview_column col-md-4  mx-auto">
                    {{-- <div class="containerssdd d-md-none d-none">
                        <div class="exzoom" id="exzoom">
                            <div class="exzoom_img_box">
                                <ul class="exzoom_img_ul">
                                    @if (is_null($product->images) || count($product->images) == 0)
                                        <li class="item">
                                            <img src="{{ asset('frontend/assets/images/default.png') }}"
                                                alt="Product Image">
                                        </li>
                                    @else
                                        @foreach ($product->images as $image)
                                            <li class="item previewPane">
                                                <img src="{{ $image->image_url }}"
                                                    data-magnify-src="{{ $image->image_url }}" alt="Product Image"
                                                    class="image_key w-100">
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="exzoom_nav"></div>
                        </div>
                    </div> --}}
                    <div class="prd_images d-md-block d-block mx-auto">
                        <div id="sync1" class="owl-carousel owl-theme">
                            @if (is_null($product->images) || count($product->images) == 0)
                                <div class="item">
                                    <img src="{{ asset('frontend/assets/images/default.png') }}" alt="Product Image">
                                </div>
                            @else
                                @foreach ($product->images as $image)
                                    <div class="item previewPane">
                                        <img src="{{ $image->image_url }}" data-magnify-src="{{ $image->image_url }}"
                                            alt="Product Image" class="image_key w-100">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div id="sync2" class="owl-carousel owl-theme mt-2">
                            @foreach ($product->images as $image)
                                <div class="item">
                                    <img src="{{ $image->image_url }}" alt="Product Image" class="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="div col-md-7">
                    <div class="prd_desc">
                        <h2 class="mb-3">{{ $product->name }}</h2>
                        <p>
                            @if ($product->brand_name)
                                <span><b>By</b>
                                    <img style="height:30px;" src="{{ asset($product?->brand_name?->image) }}"
                                        alt="">
                                    <em class="text-capitalize">{{ $product?->brand_name?->name }}</em>
                                </span>
                            @endif
                            {{-- <span class="mx-2">|</span> --}}
                        </p>
                        <p><span class="sku"><b>SKU</b> {{ $product->sku }}</span></p>
                        <p><b>Size :</b> {{ $product->weight . ' ' . $product->weight_type }}|
                            @foreach ($product->reviews as $review)
                                <div class="">
                                    <div class="">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $review->rating)
                                                <span>
                                                    <i class='bx bxs-star'></i>
                                                </span>
                                            @else
                                                <span>
                                                    <i class='bx bx-star'></i>
                                                </span>
                                            @endif
                                        @endfor
                                    </div>

                                </div>
                            @endforeach
                            <b></b>
                        </p>
                        <p> {{ $product->small_description }}</p>
                        <hr>
                        <p class="prd-price mb-1">
                            @if ($special)
                                <del>${{ $product->price }}</del>
                                ${{ $product->special_price }}
                            @else
                                ${{ $product->price }}
                            @endif
                        </p>
                        <hr>
                        <div class="detail-addtocart">
                            <div class="number">
                                <p class="mb-1">Quantity</p>
                                <div class="input-group">
                                    <a data-id="{{ $product->id }}" type="button"
                                        class="d-flex justify-content-center align-items-center button-plus qtyDecrement">-</a>
                                    <input type="text" step="1" max="" value="1" name="quantity"
                                        id="quantity-{{ $product->id }}"
                                        class="quantity-field quantity-{{ $product->id }}">
                                    <a data-id="{{ $product->id }}" type="button"
                                        class="d-flex justify-content-center align-items-center button-minus qtyIncrement">+</a>
                                </div>
                            </div>
                            <!--<div class="clearflix"></div>-->
                            <div class="">
                                <p class="mb-1">&nbsp;</p>
                                <div class="add-cart">
                                    @if ($product->inventory->inventory > 0 && $product->in_stock)
                                        <a class="addToCart" data-id="{{ $product->id }}"> Add to cart</a>
                                    @else
                                        <p class="stock-out">Out Of Stock</p>
                                        <a class="add_to_cart bg-danger text-white d-inline-block py-2 px-4"
                                            data-id="{{ $product->id }}">
                                            Out Of Stock
                                        </a>
                                    @endif
                                    @if (auth('customer')->user())
                                        @php
                                            $wishlistProductIds = auth('customer')
                                                ->user()
                                                ->wishlist()
                                                ->pluck('product_id')
                                                ->toArray();
                                            $productIdToCheck = $product->id;
                                            $isInWishlist = in_array($productIdToCheck, $wishlistProductIds);
                                        @endphp
                                        @if ($isInWishlist)
                                            <a style="min-width: 0" class="addToWishlist" data-id="{{ $product->id }}"
                                                href="{{ route('add-to-wishlist', $product->id) }}">
                                                <i style="font-size: 23px;" class='bx bxs-heart'></i>
                                            </a>
                                        @else
                                            <a style="min-width: 0" class="addToWishlist" data-id="{{ $product->id }}"
                                                href="{{ route('add-to-wishlist', $product->id) }}">
                                                <i style="font-size: 23px;" class='bx bx-heart'></i>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if (auth('customer')->user())
                            <div class="">
                                <button class="btn my-4" style="background:#93c572;border:0;color:#fff;" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#reviewForm" aria-expanded="false"
                                    aria-controls="reviewForm">
                                    Write a review
                                </button>
                            </div>
                        @endif
                        <div class="collapse" id="reviewForm">
                            <div class="card card-body">
                                <div class="mt-2">
                                    <div id="rateYo"></div>
                                    <form action="{{ route('store.review') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="rating" id="rating">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="mt-3">
                                            <label class="form-label" for="title">Title *</label>
                                            <input type="text" id="title" name="title" class="form-control"
                                                required>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-label" for="comment">Comment</label>
                                            <textarea name="comment" class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" style="background:#93c572;border:0;color:#fff;"
                                                class="btn">Submit Review
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 prd_sepcs mt-5">
                <div class="row">
                    <div class="col-md-11 px-4 mx-auto">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">Description
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">Ingredients
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#contact" type="button" role="tab" aria-controls="contact"
                                    aria-selected="false">Suggested Use
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="disclaimer-tab" data-bs-toggle="tab"
                                    data-bs-target="#disclaimer" type="button" role="tab"
                                    aria-controls="disclaimer" aria-selected="false">Disclaimer
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                    data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews"
                                    aria-selected="false">Reviews
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                {!! $product->description !!}
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                {!! $product->ingredients !!}
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                {!! $product->how_to_use !!}
                            </div>
                            <div class="tab-pane fade" id="disclaimer" role="tabpanel"
                                aria-labelledby="disclaimer-tab">
                                {!! $product->disclaimer !!}
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                @if (count($product->reviews) == 0)
                                    <p>No Reviews found</p>
                                @else
                                    <div class="pt-2">
                                        @foreach ($product->reviews as $review)
                                            <div class="">
                                                <h5>{{ $review->title }}</h5>
                                                <div class="">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $review->rating)
                                                            <span>
                                                                <i class='bx bxs-star'></i>
                                                            </span>
                                                        @else
                                                            <span>
                                                                <i class='bx bx-star'></i>
                                                            </span>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <p>{{ $review->description }}</p>
                                                <p>Review By-
                                                    <span style="font-style: italic;"
                                                        class="text-danger">{{ $review->customer->first_name . ' ' . $review->customer->last_name }}
                                                        , {{ $review->created_at->format('F d,Y') }}</span>
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($recentViewed->count() != 0)
            <div class="container secs products">
                <h2 class="sec_title">Recent Viewed Products</h2>
                <div class="owl-carousel owl-theme owl-two">
                    @foreach ($recentViewed as $product)
                        <x-products.card :product="$product" />
                    @endforeach
                </div>
            </div>
        @endif
        <div class="container secs products">
            <h2 class="sec_title">Related Products</h2>
            <div class="owl-carousel owl-theme owl-two">
                @foreach ($relatedProducts as $product)
                    <x-products.card :product="$product" />
                @endforeach
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $(".containerssdd").imagesLoaded(function() {
                    $("#exzoom").exzoom({
                        autoPlay: false
                    });
                    $("#exzoom").removeClass("hidden");
                });
                // $(".image_key").magnify({
                //     shape: "square",
                // });
            });
        </script>
        {{-- <script>
            $(document).ready(function() {
                $('.addToWishlist').click(function(event) {
                    let product_id = $(this).data("id");
                    let url = window.location.origin + "/add/wishlist";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            product_id: product_id,
                            _token: "{{ csrf_token() }}" // Include CSRF token
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Item added to wishlist')
                            }
                            if (response.error) {
                                toastr.error(response.error)
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        },
                        complete: function() {
                            $('.enquire-btn').prop('disabled', false);
                        }
                    });
                });
            });
        </script> --}}
        {{-- <script src="{{ asset('frontend/assets/tumbs.js') }}" referrerpolicy="no-referrer"></script> --}}
        <script>
            $(document).ready(function() {
                var sync1 = $("#sync1");
                var sync2 = $("#sync2");
                var syncedSecondary = true;

                sync1.owlCarousel({
                    items: 1,
                    slideSpeed: 2000,
                    nav: false,
                    autoplay: false,
                    dots: false,
                    loop: true,
                    responsiveRefreshRate: 200,
                }).on("changed.owl.carousel", function(event) {
                    syncPosition(event);
                    reinitializeZoom();
                });

                sync2.on("initialized.owl.carousel", function() {
                    sync2.find(".owl-item").eq(0).addClass("current");
                }).owlCarousel({
                    dots: false,
                    nav: true,
                    smartSpeed: 200,
                    slideSpeed: 500,
                    slideBy: 1,
                    responsiveRefreshRate: 100,
                    navText: ["<i class='bx bx-left-arrow-alt'></i>", "<i class='bx bx-right-arrow-alt'></i>"],
                    responsive: {
                        0: {
                            items: 2
                        },
                        600: {
                            items: 3
                        },
                        1000: {
                            items: 4
                        },
                        1280: {
                            items: 5
                        },
                        1400: {
                            items: 5
                        },
                        1600: {
                            items: 6
                        },
                        1800: {
                            items: 6
                        }
                    }
                }).on("changed.owl.carousel", syncPosition2);

                sync2.on("click", ".owl-item", function(e) {
                    e.preventDefault();
                    var number = $(this).index();
                    sync1.data("owl.carousel").to(number, 300, true);
                    reinitializeZoom();
                });

                function syncPosition(el) {
                    var count = el.item.count - 1;
                    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

                    if (current < 0) {
                        current = count;
                    }
                    if (current > count) {
                        current = 0;
                    }

                    sync2.find(".owl-item")
                        .removeClass("current")
                        .eq(current)
                        .addClass("current");

                    var onscreen = sync2.find(".owl-item.active").length - 1;
                    var start = sync2.find(".owl-item.active").first().index();
                    var end = sync2.find(".owl-item.active").last().index();

                    if (current > end) {
                        sync2.data("owl.carousel").to(current, 100, true);
                    }
                    if (current < start) {
                        sync2.data("owl.carousel").to(current - onscreen, 100, true);
                    }
                }

                function syncPosition2(el) {
                    if (syncedSecondary) {
                        var number = el.item.index;
                        sync1.data("owl.carousel").to(number, 100, true);
                        reinitializeZoom();
                    }
                }

                function reinitializeZoom() {
                    // Remove any existing zoom containers to avoid conflicts
                    $('.zoomContainer').remove();

                    // Find the active item in the main carousel
                    var activeItem = $('#sync1 .owl-item.active img');

                    // Apply the zoom only to the active image
                    if (activeItem.length) {
                        activeItem.ezPlus({
                            zoomType: 'inner',
                            cursor: 'crosshair',
                            onZoomedImageLoaded: function() {
                                // Customize zoom window if needed
                                $('.zoomWindow').css({
                                    'background-color': '#ffff',
                                });
                            }
                        });
                    }
                }

                reinitializeZoom();

                sync1.on('dragged.owl.carousel', function(event) {
                    reinitializeZoom();
                });

                sync1.on('translated.owl.carousel', function(event) {
                    reinitializeZoom();
                });

                $('.owl-carousel.owl-two').owlCarousel({
                    loop: false,
                    margin: 0,
                    nav: true,
                    dots: false,
                    thumbs: false,
                    navText: ["<i class='bx bx-left-arrow-alt'></i>", "<i class='bx bx-right-arrow-alt'></i>"],
                    responsive: {
                        0: {
                            items: 2
                        },
                        600: {
                            items: 3
                        },
                        700: {
                            items: 3
                        },
                        1000: {
                            items: 5
                        },
                        1280: {
                            items: 5
                        },
                        1400: {
                            items: 6
                        },
                        1600: {
                            items: 6
                        },
                        1800: {
                            items: 7
                        }
                    }
                });
            });
        </script>
        <script>
            $(function() {
                var $rateYo = $("#rateYo").rateYo({
                    fullStar: true
                });
                $("#rateYo").click(function() {
                    /* get rating */
                    var rating = $rateYo.rateYo("rating");
                    $('#rating').val(rating);
                });
            });
        </script>
        <script>
            // $(function() {
            //     $('.previewPane').mousemove(function(ev) {
            //         $('#zoomer').css('display', 'inline-block');
            //         var img = $(this).find('.image_key').attr('src');
            //         var posX = ev.offsetX ? (ev.offsetX) : ev.pageX - $(this).offset().left;
            //         var posY = ev.offsetY ? (ev.offsetY) : ev.pageY - $(this).offset().top;
            //         $('#zoomer').css('background-position', ((-posX * 1) + "px " + (-posY * 1) + "px"));
            //         $('#zoomer').css('background-image', 'url(' + img + ')');
            //         // Set z-index of previewPane to 1
            //         $(this).css('z-index', '9999999');
            //     });

            //     $('.previewPane').mouseleave(function() {
            //         $('#zoomer').css('display', 'none');
            //         $(this).css('z-index', '');
            //     });
            // });
        </script>
    @endpush
</x-app-layout>
