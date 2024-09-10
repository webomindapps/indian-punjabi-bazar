<x-app-layout>
    <div class="container-fluid brdcrumb bg-light">
        <div class="col-md-12">
            {{-- <nav aria-label="breadcrumb" class="container">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav> --}}
            <div class="container">
                <h2 class="brd_heading">Proceed Checkout</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8 pe-lg-5">
                    <div class="checkout_box">
                        <h2 class="fw-bold mb-4">Billing Details</h2>
                        <form action="{{ route('payment.initiate') }}" method="POST" id="checkoutForm">
                            @csrf
                            <div class="row">
                                @if ($cart->type == 'delivery')
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="mb-1">Delivery City</label>
                                            <input type="text" class="form-control" name="delivery_city"
                                                value="{{ $delivery_city }}" id="delivery_city" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="mb-1">Delivery price ($)</label>
                                            <input type="text" class="form-control" name="delivery_price"
                                                value="{{ $cart->price }}" readonly>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="mb-1">Pickup Location</label>
                                            <input type="text" class="form-control" value="{{ $cart->city }}"
                                                readonly>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <label class="mb-1">Booked date & time</label>
                                            <a href="{{ route('book-time') }}">Change Time</a>
                                        </div>
                                        <input type="text" class="form-control" name="delivery_city"
                                            value="{{ $cart->time }} , {{ date('d-m-Y', strtotime($cart->date)) }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="First name"
                                            id="floatingInputName" aria-label="First name" name="first_name"
                                            value="{{ $customer->first_name }}">
                                        <label for="floatingInputName">First name *</label>
                                    </div>
                                    @error('first_name')
                                        <span
                                            style="font-size:13px;color:red; margin-top:-5px; margin-bottom:5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="Last name"
                                            id="floatingInputLName" aria-label="First name" name="last_name"
                                            value="{{ $customer->last_name }}">
                                        <label for="floatingInputLName">Last name *</label>
                                    </div>
                                    @error('last_name')
                                        <span
                                            style="font-size:11px;color:red;margin-top:-5px; margin-bottom:5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput"
                                            placeholder="name@example.com" name="email"
                                            value="{{ $customer->email }}">
                                        <label for="floatingInput">Email *</label>
                                    </div>
                                    @error('email')
                                        <span
                                            style="font-size:11px;color:red;margin-top:-5px; margin-bottom:5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" inputmode="numeric" name="phone" maxlength="15"
                                            oninput="this.value = this.value.replace(/\D/g, '')" class="form-control"
                                            id="floatingphone" placeholder="Enter phone number" name="phone"
                                            value="{{ $customer->phone }}">
                                        <label for="floatingphone">Phone *</label>
                                    </div>
                                    @error('phone')
                                        <span
                                            style="font-size:11px;color:red;margin-top:-5px; margin-bottom:5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="Company name"
                                            id="floatingInputCName"  name="company_name">
                                        <label for="floatingInputCName">Company name (optional)</label>
                                    </div>
                                </div> --}}
                                <div class="col-md-12 mt-1 mb-3">
                                    <hr>
                                </div>
                                <p id="address_err" style="font-size:13px;color:red;"></p>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="Address"
                                            id="floatingInputAddress" name="address" value="{{ old('address') }}">
                                        <label for="floatingInputAddress">Address *</label>
                                    </div>
                                    @error('address')
                                        <span
                                            style="font-size:11px;color:red;margin-top:-5px; margin-bottom:5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="State"
                                            id="administrative_area_level_1" name="state"
                                            value="{{ old('state') }}">
                                        <label for="administrative_area_level_1">State *</label>
                                    </div>
                                    @error('state')
                                        <span
                                            style="font-size:11px;color:red;margin-top:-5px; margin-bottom:5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="State"
                                            id="locality" name="city" value="{{ old('city') }}">
                                        <label for="locality">City *</label>
                                    </div>
                                    @error('city')
                                        <span
                                            style="font-size:11px;color:red;margin-top:-5px; margin-bottom:5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="Zip code"
                                            id="postal_code" name="pincode" value="{{ old('pincode') }}">
                                        <label for="postal_code">Zip Code *</label>
                                    </div>
                                    @error('pincode')
                                        <span
                                            style="font-size:11px;color:red;margin-top:-5px; margin-bottom:5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" name="note" placeholder="Leave a comment here" id="floatingInputOrdernotes"
                                            style="height: 100px"></textarea>
                                        <label for="floatingInputOrdernotes">Order notes (optional)</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="checkout-prd">
                        <h2 class="fw-bold mb-4 d-md-block d-none">&nbsp;</h2>
                        <div class="order-summary rounded border">
                            <h3 class="text-center p-3 bg-light">Cart Summary</h3>
                            <div class="row">
                                <span class="col-8">Sub Total</span>
                                <span id="sm-subtotal" class="col-4 text-right">${{ $cart->total_amount }}</span>
                            </div>
                            <div class="row">
                                <span class="col-8">Taxable Product SubTotal</span>
                                <span id="sm-subtotal" class="col-4 text-right">
                                    ${{ number_format($cart->tax_total ?? 0, 2) }}
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-8">Coupon Discount</span>
                                <span id="sm-subtotal" class="col-4 text-right">
                                    ${{ number_format($cart->discount_amount ?? 0, 2) }}
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-8">Tax 13 %</span>
                                <span id="tax-total" class="col-4 text-right">
                                    ${{ number_format($cart->tax ?? 0, 2) }}
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-8">Delivery Charge</span>
                                <span id="sm-subtotal" class="col-4 text-right">
                                    ${{ number_format($cart->price ?? 0, 2) }}
                                </span>
                            </div>
                            <div id="grand-total-detail" class="payable-amount row">
                                <span class="col-8">Grand Total</span>
                                <span id="grand-total" class="col-4 text-right fw6">
                                    ${{ number_format($cart->grand_total + $cart->price ?? 0, 2) }}
                                </span>
                            </div>
                            <div class="proceed"> <a id="submitBtn">Proceed to checkout</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-5">
                <div class="col-auto text-center">
                    <p>Your personal data will be used to process your order, support your experience throughout this
                        website, and for other purposes described in our <a href="#">privacy policy.</a></p>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                loadAddress()
                $('#locality').on('change', function() {
                    const deliveryCity = $('#delivery_city').val();
                    if ($(this).val() != deliveryCity) {
                        clearAddressFields();
                        $('#address_err').html('Invalid Address. Please enter a valid address in ' +
                            deliveryCity + '.');
                    } else {
                        $('#address_err').html('');
                    }
                });
            });

            function loadAddress() {

                const componentForm = {
                    administrative_area_level_1: "long_name",
                    postal_code: "short_name",
                    locality: "long_name"
                };

                var localeKeyword = "Toronto"
                var autocomplete;
                var thiss = this;
                var searchInput = 'floatingInputAddress';
                autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
                    strictBounds: false,
                    types: ['establishment', 'geocode'],
                    componentRestrictions: {
                        country: "CA"
                    },
                    fields: ['address_components'],
                });

                google.maps.event.addListener(autocomplete, 'place_changed', function() {
                    let validAddress = true;
                    var place = autocomplete.getPlace();
                    for (const component of place.address_components) {
                        const addressType = component.types[0];
                        if (componentForm[addressType]) {
                            const val = component[componentForm[addressType]];
                            console.log(val, '#' + addressType);

                            $('#' + addressType).val(val);
                        }
                        if (addressType == 'postal_code') {

                            var number = component[componentForm[addressType]].replace(/\s+/g, '')
                            if (number.length == 6) {
                                number = number.replace(/^(.{3})(.{3})$/, "$1 $2");
                            } else if (number.length > 6) {
                                number = number.substring(0, 6)
                                number = number.replace(/^(.{3})(.{3})$/, "$1 $2");
                            }
                            console.log('here', number.substring(0, 7));
                            $('#postal_code').val(number.substring(0, 7));
                        }
                        if (addressType == 'locality') {
                            const locality = component[componentForm[addressType]];
                            const deliveryCity = $('#delivery_city').val();
                            if (deliveryCity != locality) {
                                validAddress = false;
                                $('#address_err').html('Invalid Address. Please enter a valid address in ' +
                                    deliveryCity + '.');
                            } else {
                                $('#address_err').html('');
                            }
                        }
                    }
                    if (!validAddress) {
                        clearAddressFields();
                    }
                });
            }

            function clearAddressFields() {
                $('#floatingInputAddress').val('');
                $('#administrative_area_level_1').val('');
                $('#locality').val('');
                $('#postal_code').val('');
            }
            $('#submitBtn').click(function() {
                $('#checkoutForm').submit();
            });
        </script>
    @endpush
</x-app-layout>
