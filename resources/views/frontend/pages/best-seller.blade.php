<x-app-layout>
    <div class="content mt-4 list_page ">
        <div class="container mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Best Sellers</li>
                </ol>
            </nav>
        </div>
        <div class="container secs listing_wrapper">
            <div class="col-12 d-flex">
                <a href="" class="btn w-100 filter-btn shadow-none border mb-2 d-md-none d-block">Filter
                    Categories <i class='bx bx-filter'></i></a>
                <div class="sidebar">
                    <a href=""
                        class="btn w-100 filter-btn shadow-none border d-flex justify-content-between align-itmes-center mb-2 d-md-none d-block bg-danger text-white">Close
                        Filter Categories <i class='bx bx-x fs-4'></i></a>
                    {{-- <ul class="list-group">
                        <li class="list-group-item">
                            <a class="btn btn-category" data-bs-toggle="collapse" href="#collapseExample" role="button"
                                aria-expanded="true" aria-controls="collapseExample"> Category <i
                                    class='bx bx-chevron-down pt-1 float-end'></i> </a>
                            <div class="collapse show" id="collapseExample">
                                <div class="card card-body bg-white">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Amino Acids (755)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked1">
                                        <label class="form-check-label" for="flexCheckChecked1">
                                            Children's Health (153)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault2">
                                        <label class="form-check-label" for="flexCheckDefault2">
                                            Collagen (315)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked3">
                                        <label class="form-check-label" for="flexCheckChecked3">
                                            Drinks (5769)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault4">
                                        <label class="form-check-label" for="flexCheckDefault4">
                                            Enzymes (858)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault4">
                                        <label class="form-check-label" for="flexCheckDefault4">
                                            Facial Care (85)
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Herbal Supplements (755)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked1">
                                        <label class="form-check-label" for="flexCheckChecked1">
                                            Hair Care (153)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault2">
                                        <label class="form-check-label" for="flexCheckDefault2">
                                            Minerals (315)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked3">
                                        <label class="form-check-label" for="flexCheckChecked3">
                                            Mushroom Extracts (5769)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault4">
                                        <label class="form-check-label" for="flexCheckDefault4">
                                            Men's Health (858)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault4">
                                        <label class="form-check-label" for="flexCheckDefault4">
                                            Make-up (85)
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Bath & Body Care (755)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked1">
                                        <label class="form-check-label" for="flexCheckChecked1">
                                            Omega Fatty Acids (153)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault2">
                                        <label class="form-check-label" for="flexCheckDefault2">
                                            Probiotics (315)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked3">
                                        <label class="form-check-label" for="flexCheckChecked3">
                                            Pre-workout (5769)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault4">
                                        <label class="form-check-label" for="flexCheckDefault4">
                                            Post-workout (858)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault4">
                                        <label class="form-check-label" for="flexCheckDefault4">
                                            Oils (85)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault4">
                                        <label class="form-check-label" for="flexCheckDefault4">
                                            Vitamins (85)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault4">
                                        <label class="form-check-label" for="flexCheckDefault4">
                                            Women's Health care (85)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <a class="btn btn-category" data-bs-toggle="collapse" href="#collapseExample1"
                                role="button" aria-expanded="false" aria-controls="collapseExample1"> Brands <i
                                    class='bx bx-chevron-down pt-1 float-end'></i> </a>
                            <div class="collapse" id="collapseExample1">
                                <div class="card card-body bg-white">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            3 Brains (5)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked6">
                                        <label class="form-check-label" for="flexCheckChecked6">
                                            4Ever Fit (1)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault7">
                                        <label class="form-check-label" for="flexCheckDefault7">
                                            A. Vogel (45)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked8">
                                        <label class="form-check-label" for="flexCheckChecked8">
                                            Activation Products (1)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault9">
                                        <label class="form-check-label" for="flexCheckDefault9">
                                            Active Green Pro (7)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <a class="btn btn-category" data-bs-toggle="collapse" href="#collapseExample2"
                                role="button" aria-expanded="false" aria-controls="collapseExample2"> Specialties <i
                                    class='bx bx-chevron-down pt-1 float-end'></i> </a>
                            <div class="collapse" id="collapseExample2">
                                <div class="card card-body bg-white">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            Organic (568)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked6">
                                        <label class="form-check-label" for="flexCheckChecked6">
                                            Vegan (2076)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault7">
                                        <label class="form-check-label" for="flexCheckDefault7">
                                            Plant Based (119)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked8">
                                        <label class="form-check-label" for="flexCheckChecked8">
                                            Grass Fed (52)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault9">
                                        <label class="form-check-label" for="flexCheckDefault9">
                                            Non-GMO (3768)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <a class="btn btn-category" data-bs-toggle="collapse" href="#collapseExample3"
                                role="button" aria-expanded="false" aria-controls="collapseExample3"> On Sale <i
                                    class='bx bx-chevron-down pt-1 float-end'></i> </a>
                            <div class="collapse" id="collapseExample3">
                                <div class="card card-body bg-white">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            On Sale (768)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <a class="btn btn-category" data-bs-toggle="collapse" href="#collapseExample4"
                                role="button" aria-expanded="false" aria-controls="collapseExample4"> Price <i
                                    class='bx bx-chevron-down pt-1 float-end'></i> </a>
                            <div class="collapse" id="collapseExample4">
                                <div class="card card-body bg-white">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            $0.00 - $100.00 (7009)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            $100.00 - $200.00 (700)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            $200.00 - $300.00 (7)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <a class="btn btn-category" data-bs-toggle="collapse" href="#collapseExample4"
                                role="button" aria-expanded="false" aria-controls="collapseExample4"> Strength <i
                                    class='bx bx-chevron-down pt-1 float-end'></i> </a>
                            <div class="collapse" id="collapseExample4">
                                <div class="card card-body bg-white">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            1M (9)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            1mg (70)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            2mg (2)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            3mg (20)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            3X (1)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <a class="btn btn-category" data-bs-toggle="collapse" href="#collapseExample5"
                                role="button" aria-expanded="false" aria-controls="collapseExample5"> Flavor <i
                                    class='bx bx-chevron-down pt-1 float-end'></i> </a>
                            <div class="collapse" id="collapseExample5">
                                <div class="card card-body bg-white">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            Acai & Mango (9)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            Acai Berry (4)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            American Ginseng (2)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            Apple (20)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            Apple Cinder (1)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul> --}}

                </div>
                <div class="products_list_box">
                    <div class="item">
                        <div class="prd-box">
                            <span class="prd-img">
                                <img src="{{ asset('frontend/assets/images/products/prd-6.jpg') }}" class="img-fluid">
                            </span>
                            <div class="prd-desc">
                                <span class="d-block prd-name"><a href="#">Inlife Heart Care Supplement
                                        Vegetarian Capsules</a></span>
                                <span class="price"><del>$150</del> $130</span>
                                <span class="ratings"><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star'></i></span>

                                <a href="#" class="add_to_cart"><i class='bx bx-cart-add'></i> Add</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="prd-box">
                            <span class="onsale">Sale!</span>
                            <span class="prd-img">
                                <img src="{{ asset('frontend/assets/images/products/prd-7.jpg') }}" class="img-fluid">
                            </span>
                            <div class="prd-desc">
                                <span class="d-block prd-name"><a href="#">Dettol Germ Protection Handwash
                                        Liquid</a></span>
                                <span class="price"><del>$30</del> $22</span>
                                <span class="ratings"><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star'></i></span>

                                <a href="#" class="add_to_cart"><i class='bx bx-cart-add'></i> Add</a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="prd-box">
                            <span class="onsale">Sale!</span>
                            <span class="prd-img">
                                <img src="{{ asset('frontend/assets/images/products/prd-7.jpg') }}" class="img-fluid">
                            </span>
                            <div class="prd-desc">
                                <span class="d-block prd-name"><a href="#">Dettol Germ Protection Handwash
                                        Liquid</a></span>
                                <span class="price"><del>$30</del> $22</span>
                                <span class="ratings"><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star'></i></span>

                                <a href="#" class="add_to_cart"><i class='bx bx-cart-add'></i> Add</a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="prd-box">
                            <span class="prd-img">
                                <img src="{{ asset('frontend/assets/images/products/prd-4.jpg') }}" class="img-fluid">
                            </span>
                            <div class="prd-desc">
                                <span class="d-block prd-name"><a href="#">TV Night Light Alarm Clock for
                                        patient Desk</a></span>
                                <span class="price"><del>$105</del> $95</span>
                                <span class="ratings"><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star'></i></span>

                                <a href="#" class="add_to_cart"><i class='bx bx-cart-add'></i> Add</a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="prd-box">
                            <span class="onsale">Sale!</span>
                            <span class="prd-img">
                                <img src="{{ asset('frontend/assets/images/products/prd-3.jpg') }}" class="img-fluid">
                            </span>
                            <div class="prd-desc">
                                <span class="d-block prd-name"><a href="#">Generic Stethoscope Hearing Heartbeat
                                        Tool</a></span>
                                <span class="price"><del>$100</del> $90</span>
                                <span class="ratings"><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star'></i></span>

                                <a href="#" class="add_to_cart"><i class='bx bx-cart-add'></i> Add</a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="prd-box">
                            <span class="prd-img">
                                <img src="{{ asset('frontend/assets/images/products/prd-1.jpg') }}" class="img-fluid">
                            </span>
                            <div class="prd-desc">
                                <span class="d-block prd-name"><a href="#">Best Non-Contact Infrared
                                        Thermometer</a></span>
                                <span class="price"><del>$96</del> $89</span>
                                <span class="ratings"><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star'></i></span>

                                <a href="#" class="add_to_cart"><i class='bx bx-cart-add'></i> Add</a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="prd-box">
                            <span class="prd-img">
                                <img src="{{ asset('frontend/assets/images/products/prd-2.jpg') }}" class="img-fluid">
                            </span>
                            <div class="prd-desc">
                                <span class="d-block prd-name"><a href="#">5 Layer Filter Protection Mask For
                                        Adults</a></span>
                                <span class="price"><del>$75</del> $68</span>
                                <span class="ratings"><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star'></i></span>

                                <a href="#" class="add_to_cart"><i class='bx bx-cart-add'></i> Add</a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="prd-box">
                            <span class="prd-img">
                                <img src="{{ asset('frontend/assets/images/products/prd-4.jpg') }}" class="img-fluid">
                            </span>
                            <div class="prd-desc">
                                <span class="d-block prd-name"><a href="#">TV Night Light Alarm Clock for
                                        patient Desk</a></span>
                                <span class="price"><del>$105</del> $95</span>
                                <span class="ratings"><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star'></i></span>

                                <a href="#" class="add_to_cart"><i class='bx bx-cart-add'></i> Add</a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="prd-box">
                            <span class="onsale">Sale!</span>
                            <span class="prd-img">
                                <img src="{{ asset('frontend/assets/images/products/prd-3.jpg') }}" class="img-fluid">
                            </span>
                            <div class="prd-desc">
                                <span class="d-block prd-name"><a href="#">Generic Stethoscope Hearing Heartbeat
                                        Tool</a></span>
                                <span class="price"><del>$100</del> $90</span>
                                <span class="ratings"><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star'></i></span>

                                <a href="#" class="add_to_cart"><i class='bx bx-cart-add'></i> Add</a>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="prd-box">
                            <span class="prd-img">
                                <img src="{{ asset('frontend/assets/images/products/prd-6.jpg') }}"
                                    class="img-fluid">
                            </span>
                            <div class="prd-desc">
                                <span class="d-block prd-name"><a href="#">Inlife Heart Care Supplement
                                        Vegetarian Capsules</a></span>
                                <span class="price"><del>$150</del> $130</span>
                                <span class="ratings"><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star'></i></span>

                                <a href="#" class="add_to_cart"><i class='bx bx-cart-add'></i> Add</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="prd-box">
                            <span class="onsale">Sale!</span>
                            <span class="prd-img">
                                <img src="{{ asset('frontend/assets/images/products/prd-7.jpg') }}"
                                    class="img-fluid">
                            </span>
                            <div class="prd-desc">
                                <span class="d-block prd-name"><a href="#">Dettol Germ Protection Handwash
                                        Liquid</a></span>
                                <span class="price"><del>$30</del> $22</span>
                                <span class="ratings"><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star'></i></span>

                                <a href="#" class="add_to_cart"><i class='bx bx-cart-add'></i> Add</a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="prd-box">
                            <span class="onsale">Sale!</span>
                            <span class="prd-img">
                                <img src="{{ asset('frontend/assets/images/products/prd-7.jpg') }}"
                                    class="img-fluid">
                            </span>
                            <div class="prd-desc">
                                <span class="d-block prd-name"><a href="#">Dettol Germ Protection Handwash
                                        Liquid</a></span>
                                <span class="price"><del>$30</del> $22</span>
                                <span class="ratings"><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star active'></i><i
                                        class='bx bxs-star active'></i><i class='bx bxs-star'></i></span>

                                <a href="#" class="add_to_cart"><i class='bx bx-cart-add'></i> Add</a>
                            </div>
                        </div>
                    </div>
                    <div class="item empty"></div>
                    <div class="item empty"></div>
                    <div class="item empty"></div>
                    <div class="item empty"></div>
                    <div class="item empty"></div>
                    <div class="item empty"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
