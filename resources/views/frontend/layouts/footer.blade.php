<div class="container-fluid footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="c_details relative pe-2">
                    {{-- <p>{{ Punjabi::settings()?->logo }}</p> --}}
                    <p><img src="{{ url('frontend/assets/images/logo.png') }}" alt="" class="img-fluid f_logo"></p>
                    <h2>Contact Us</h2>
                    <p>{{ Punjabi::settings()?->address }}</p>
                    <p>
                        <a href="mailto:{{ Punjabi::settings()?->contact_email }}">
                            {{ Punjabi::settings()?->contact_email }}
                        </a>
                    </p>
                    <p class="tel">
                        <a href="tel:{{ Punjabi::settings()?->phone }}">
                            {{ Punjabi::settings()?->phone }}
                        </a>
                    </p>
                    {{-- <h2>Hours</h2>
                    <p class="tel">
                        {!! Punjabi::settings()?->working_hours !!}
                    </p> --}}
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3 col-6">
                        <h2>Need Help ?</h2>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Redeem Voucher</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Latest News</a></li>
                            <li><a href="#">Shipping</a></li>
                            <li><a href="#">Payment</a></li>
                            <li><a href="#">Store Location</a></li>
                            <li><a href="#">Affiliate Program</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-6">
                        <h2>Navigation Links</h2>
                        <ul>
                            @foreach (Punjabi::topCategories() as $category)
                                <li><a
                                        href="{{ route('productByCategory', $category->slug) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                            {{-- <li><a href="{{ route('career') }}">Career</a></li>
                            <li><a href="{{ asset(Punjabi::flyer()?->file) }}" download>Monthly Flyer</a></li>
                            <li><a href="{{ route('customer.wishlist') }}">Wishlist</a></li>
                            <li><a href="{{ route('book-time') }}">Checkout</a></li>
                            <li><a href="{{ route('customer.profile') }}">My Account</a></li> --}}
                            <li><a href="#">Order Status</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Locality</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms & Condition</a></li>
                        </ul>
                    </div>
                    <div class="col-md-5 mt-sm-0 mt-4">
                        <h2>Get Our Latets Update !</h2>
                        <p>Subscribe our latest newsletter to get news about special discounts.</p>
                        <form action="{{ route('new.subscription') }}" method="POST">
                            @csrf
                            <input type="email" name="email" placeholder="Email Id" required class="form-control">
                            @error('email')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                            <input type="submit" value="Subscribe" class="btn subcribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row copyrights">

            <div class="col-md-8">
                <div class="text-start">
                    <p class="mb-0">© {{ date('Y') }} Indian Punjabi Bazaar. All Rights Reserved</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <img src="{{ asset('frontend/assets/images/payment-opt.jpg') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
