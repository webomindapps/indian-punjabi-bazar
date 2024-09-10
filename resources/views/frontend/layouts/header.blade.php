<div class="head_wrapper">
    <div class="topbar d-none">
        <div class="container d-flex align-items-center p-0">
            <div class="store_info">
                <ul class="list-styled d-flex align-items-center">
                    <li class="d-contents login"><a href="#"><i class='bx bx-map'></i> 115 Father Tobin Rd, Brampton,
                            ON L6R 0W9</a></li>
                    <li class="d-contents pipe mx-3">|</li>
                    <li class="d-contents login"><i class='bx bx-time-five'></i> Monday - Sunday : 10:00 AM to 8:30 PM
                    </li>
                </ul>
            </div>
            {{-- <div class="col-lg-2 col-4">
                <div class="address">
                    <ul class="header-top-left text-right mb-0">
                        @php
                            $customer = Auth::guard('customer')->user();
                        @endphp
                        @if (is_null($customer))
                            <li class="d-contents login">
                                <a href="{{ route('customer.login') }}">
                                    Login
                                </a>
                            </li>
                            <li class="d-contents login">
                                <a href="{{ route('customer.register') }}">Signup</a>
                            </li>
                        @else
                            <div class="btn-group">
                                <button type="button" class="btn btn-dark btn-sm dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $customer->first_name }}
                                    <i class='bx bxs-chevron-down'></i>
                                </button>
                                <ul class="dropdown-menu bg-dark">
                                    <li>
                                        <a class="dropdown-item text-white" href="{{ route('customer.profile') }}">
                                            <i class='bx bx-user me-1'></i>
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-white" href="{{ route('customer.orders') }}">
                                            <i class='bx bx-package me-1'></i>
                                            Orders
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-white" href="{{ route('customer.wishlist') }}">
                                            <i class='bx bx-heart me-1'></i>
                                            Wishlist
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-white" href="{{ route('customer.logout') }}">
                                            <i class='bx bx-log-out-circle me-1'></i>
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endif

                    </ul>
                </div>
            </div> --}}
        </div>
    </div>

    <div class="logo_header col-12 px-lg-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset(Punjabi::settings()->logo ?? 'frontend/assets/images/logo.png') }}"
                            alt="" class="img-fluid">
                        {{-- <img src="frontend/assets/images/logo.png" alt="" class="img-fluid"> --}}

                    </a>
                </div>

                <div class="search relative" id="search-div">
                    <div class="row relative">
                        <input type="text" class="form-control ds-input" id="search-input" placeholder="Search..."
                            autocomplete="off">
                        <button type="button" class="btn"><i class='bx bx-search'></i></button>
                    </div>
                    <div class="search-results" style="display: none;">
                        <ul class="list-styled" id="searched-item-List">
                            {{-- dynamic searched items --}}
                        </ul>
                    </div>
                </div>

                <div class="side_links pe-0">
                    <ul class="list-styled justify-content-end">

                        <li class="d-contents login">
                            <ul class="header-top-left text-right mb-0">
                                @php
                                    $customer = Auth::guard('customer')->user();
                                @endphp
                                @if (is_null($customer))
                                    <li class="d-contents login">
                                        <a href="{{ route('customer.login') }}">
                                            Login
                                        </a>
                                    </li>
                                    <li class="d-contents login">
                                        <a href="{{ route('customer.register') }}">Signup</a>
                                    </li>
                                @else
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ $customer->first_name }}
                                            <i class='bx bxs-chevron-down'></i>
                                        </button>
                                        {{-- <ul class="dropdown-menu bg-dark">
                                            <li>
                                                <a class="dropdown-item text-white"
                                                    href="{{ route('customer.profile') }}">
                                                    <i class='bx bx-user me-1'></i>
                                                    Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-white"
                                                    href="{{ route('customer.orders') }}">
                                                    <i class='bx bx-package me-1'></i>
                                                    Orders
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-white"
                                                    href="{{ route('customer.wishlist') }}">
                                                    <i class='bx bx-heart me-1'></i>
                                                    Wishlist
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-white"
                                                    href="{{ route('customer.logout') }}">
                                                    <i class='bx bx-log-out-circle me-1'></i>
                                                    Logout
                                                </a>
                                            </li>
                                        </ul> --}}
                                    </div>
                                @endif

                            </ul>
                        </li>
                        <li class="d-contents icons"><a href="{{ route('customer.profile') }}"><i
                                    class='bx bx-user'></i></a></li>
                        <li class="d-contents icons"><a href="{{ route('customer.wishlist') }}"><i
                                    class='bx bx-heart'></i></a></li>
                        {{-- <li class="d-contents icons"><a href="{{ route('cart') }}"><i class='bx bx-cart-alt'></i></a>
                        </li> --}}
                        <li class="d-contents icons" id="miniCart">
                            <a href="{{ route('cart') }}" class="my-cart d-md-inline d-none">
                                <span class="cart-text"> My Cart</span>
                                <i class='bx bx-cart-alt'></i>
                                <span class="add_cnt circle" id="item-count">0</span>
                            </a>
                            <a class="my-cart d-md-none mt-0" data-bs-toggle="collapse" data-bs-target="#hovedCart"
                                aria-controls="hovedCart" aria-expanded="false">
                                <span class="cart-text"> My Cart</span>
                                <i class='bx bx-cart-alt'></i>
                                <span class="add_cnt circle" id="item-count-sm">0</span>
                            </a>
                            @if (request()->route()->getName() !== 'checkout')
                                <div class="cart_card navbar-collapse" id="hovedCart">

                                </div>
                            @endif
                        </li>
                    </ul>
                    {{-- <div class="contact_info d-flex d-none align-items-center justify-content-end">
                        <div class="call_icon">
                            <svg id="Layer_1" version="1.1" viewBox="0 0 32 32" width="32px" height="32px"
                                xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g transform="translate(96 384)" fill="#89c24e">
                                    <path
                                        d="M-65.224-359.142l-0.147-0.445c-0.353-1.045-1.504-2.135-2.563-2.422l-3.918-1.07c-1.063-0.289-2.578,0.1-3.354,0.877   l-1.418,1.418c-5.153-1.393-9.194-5.434-10.586-10.586l1.418-1.418c0.777-0.777,1.166-2.291,0.878-3.354l-1.068-3.92   c-0.289-1.063-1.381-2.214-2.424-2.563l-0.447-0.15c-1.045-0.348-2.535,0.004-3.313,0.781l-2.12,2.123   c-0.38,0.377-0.621,1.455-0.621,1.459c-0.074,6.734,2.565,13.225,7.33,17.986c4.752,4.752,11.216,7.389,17.931,7.332   c0.035,0,1.145-0.238,1.523-0.615l2.12-2.121C-65.228-356.604-64.875-358.097-65.224-359.142L-65.224-359.142z" />
                                </g>
                            </svg>
                        </div>
                        <div class="contact_list ms-4">
                            <p class="mb-1">Call To <a href="tel:+1800090098">+1800090098</a></p>
                            <p class="mb-0">Email - <a href="mailto:info@gmail.com">info@gmail.com</a></p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="menubar">
        <nav class="navbar navbar-expand-lg container py-1">
            <div class="col-12 p-0">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <!--
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Shop By
                                Category<i class='bx bx-chevron-down'></i></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('all.brands') }}"> Brands</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('productByCategory', 'categorysearch') }}?is_best_seller=1">
                                        Best
                                        Sellers </a></li>
                                {{-- <li><a class="dropdown-item" href="{{ route('all.categories') }}"> Categories</a>
                                </li> --}}
                                {{-- <li><a class="dropdown-item" href="{{ route('all.healths') }}"> Health Goals and
                                        Concerns </a></li> --}}
                                <li><a class="dropdown-item"
                                        href="{{ route('productByCategory', 'categorysearch') }}?is_new=1"> New
                                        Arrivals</a></li>
                            </ul>
                        </li>
                        <x-partial-category />

                        <li class="nav-item">
                            <a class="dropdown-item"
                                href="{{ route('productByCategory', 'categorysearch') }}?sale=1">Deals</a>


                        </li>

                        {{-- <li class="nav-item">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">About Us<i
                                    class='bx bx-chevron-down'></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">New Arrivals
                                <i class='bx bx-chevron-down'></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Sale Items
                                <i class='bx bx-chevron-down'></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Weekly
                                Specials <i class='bx bx-chevron-down'></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pe-0 me-0 dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                href="#">Deals <i class='bx bx-chevron-down'></i></a>
                        </li> --}}
                    </ul>

                    <div class="store ms-auto me-0 d-flex align-items-center">
                        <a class="d-flex align-items-center me-3" href="{{ route('customer.login') }}"><i
                                class='bx bx-log-in-circle me-2'></i> Return customers </a>
                        <a class="d-flex align-items-center" href="{{ route('customer.register') }}"><i
                                class='bx bx-user-plus me-2'></i> New
                            Customers </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function applyMenuBehavior() {
            var menuItems = document.querySelectorAll('.menu-item');

            menuItems.forEach(function(item) {
                item.addEventListener('click', function(e) {
                    // Prevent default action
                    e.preventDefault();
                    var dropdownMenu = this.nextElementSibling;
                    if (dropdownMenu.style.display === 'block') {
                        dropdownMenu.style.display = 'none';
                    } else {
                        dropdownMenu.style.display = 'block';
                    }
                });
            });
        }

        // Check screen width on initial load and when resizing
        function checkScreenWidth(mq) {
            if (mq.matches) {
                applyMenuBehavior();
            }
        }

        var mq = window.matchMedia('(max-width: 991.98px)');
        checkScreenWidth(mq);
        mq.addListener(checkScreenWidth);
    });
</script>
