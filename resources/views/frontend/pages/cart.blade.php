<x-app-layout>
    <style>
        .container-norm {
            max-width: 1140px;
            margin: auto;
            padding-left: 12px;
            padding-right: 12px;
        }

        .text-green,
        p a {
            color: var(--green);
        }

        p a:hover {
            color: #000;
            text-decoration: underline;
        }

        .quantity {
            border: 1px solid #dddddd;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
            overflow: hidden;
            display: flex;
            width: 150px;
        }

        .quantity .input-group-btn {
            display: flex;
            flex: 0 0 40px;
        }

        .quantity .input-group-btn .quantity-btn {
            width: 50px;
            height: 100%;
            justify-content: center;
            align-items: center;
            display: flex;
            -webkit-transition: 0.3s ease-in-out;
            transition: 0.3s ease-in-out;
            cursor: pointer;
            font-size: 0.875rem;
            color: #a3a3a3;
        }

        .quantity .input-group-btn .quantity-btn.quantity-plus {
            border-width: 0 0 0 1px;
        }

        .quantity .input-group-btn .quantity-btn.quantity-minus {
            border-width: 1px 0 0 1px;
        }

        .quantity .qty {
            -webkit-box-shadow: none;
            box-shadow: none;
            height: 48px;
            text-align: center;
            padding: 1px;
            background-color: #fff;
            font-size: 16px;
            line-height: 1;
            color: #000;
            width: 50px;
            outline: 0;
            margin: 0;
            border: none;
            border-right: 1px solid #dddddd;
            border-left: 1px solid #dddddd;
        }

        .quantity input[type=number] {
            -webkit-appearance: textfield;
            -moz-appearance: textfield;
            appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        @media screen and (max-width: 767px) {

            .quantity .qty {
                height: 35px;
                width: 55px;
            }

            .quantity .input-group-btn .quantity-btn {
                width: 40px;
            }
        }

        .coupon-applied {
            padding: 10px 20px;
            border-radius: 15px;
            background: #93c572;
            color: white;
            font-weight: 600;
            position: relative;
        }

        .remove-coupon {
            position: absolute;
            top: -5px;
            right: -5px;
            height: 20px;
            width: 20px;
            background: red;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #000;
            border-radius: 50%;
        }
    </style>
    <div class="container-fluid brdcrumb bg-light">
        <div class="col-md-12">
            <div class="container">
                <h2 class="brd_heading">View Products Added To Your Cart</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="cart_updated" style="display: none">
            <i class='bx bxs-check-circle'></i> Cart updated.
            <span class="float-end" onclick="$('.cart_updated').hide();">
                <i class='bx bx-x'></i>
            </span>
        </div>
        <div class="row cart-prd">
            <div class="col-lg-8 col-md-12">
                <div class="view-mode">
                    <div
                        class="rango-view-grid-container mode grid {{ request()->mode == 'grid' || request()->mode == '' ? 'active' : '' }}">
                        <i class='bx bx-list-ul'></i>
                        <span>list view</span>
                    </div>
                    <div class="rango-view-list-container mode list {{ request()->mode == 'list' ? 'active' : '' }}">
                        <i class='bx bx-grid-alt'></i>
                        <span>Grid view</span>
                    </div>
                </div>
                <div class="cart-prd-table">
                    @if (request()->mode == 'list')
                        <div class="row mb-5">
                            @if (is_null($cart) || count($cart?->items) == 0)
                                <p class="text-center">Your cart is empty</p>
                            @else
                                @foreach ($cart?->items as $item)
                                    @php
                                        $price = $item?->product->price;
                                        $today = date('Y-m-d');
                                        if ($item->product?->special_price_from) {
                                            if (
                                                $item->product?->special_price_from <= $today &&
                                                $item->product?->special_price_to >= $today
                                            ) {
                                                $price = $item?->product->special_price;
                                            }
                                        }
                                    @endphp
                                    <div class="col-lg-3">
                                        <div class="item cart_grid_view">
                                            <div class="prd-box">
                                                <a href="{{ route('productByCategory', $item?->product->url_key) }}">
                                                    <span class="prd-img">
                                                        @if (count($item?->product->images))
                                                            <img src="{{ asset($item?->product?->images[0]->image_url) }}"
                                                                class="img-fluid w-100">
                                                        @else
                                                            <img src="{{ asset('frontend/assets/images/default.png') }}"
                                                                class="img-fluid w-100">
                                                        @endif
                                                    </span>
                                                </a>
                                                <div class="prd-desc">
                                                    <span class="d-block prd-name">
                                                        <a
                                                            href="{{ route('productByCategory', $item?->product->url_key) }}">{{ $item?->product->name }}</a>
                                                    </span>
                                                    <div class="d-flex justify-content-between">
                                                        <span class="price">
                                                            ${{ number_format($price ?? 0, 2) }}
                                                        </span>
                                                        <div class="justify-content-end">
                                                            <div class="quantity">
                                                                <div class="input-group-btn">
                                                                    <span class="quantity-btn quantity-minus">
                                                                        <i class='bx bx-minus' aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="number" data-price="{{ $price }}"
                                                                    data-id="{{ $item->id }}"
                                                                    class="input-text qty crtItmQty text quantity-{{ $item->id }}"
                                                                    step="1" min="0" name=""
                                                                    value="{{ $item->quantity }}" title="Qty"
                                                                    placeholder="" inputmode="numeric">
                                                                <div class="input-group-btn">
                                                                    <span class="quantity-btn quantity-plus">
                                                                        <i class='bx bx-plus' aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a class="add_to_cart addToCart "
                                                        onclick="return confirm('Are you sure you want to delete this?')"
                                                        href="{{ route('delete-cart', $item->id) }}">
                                                        <i class='bx bx-cart-add'></i> Remove
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (is_null($cart) || count($cart?->items) == 0)
                                    <tr>
                                        <td colspan="5">
                                            <p class="text-center">Your cart is empty</p>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($cart?->items as $item)
                                        @php
                                            $price = $item?->product->price;
                                            $today = date('Y-m-d');
                                            if ($item->product?->special_price_from) {
                                                if (
                                                    $item->product?->special_price_from <= $today &&
                                                    $item->product?->special_price_to >= $today
                                                ) {
                                                    $price = $item?->product->special_price;
                                                }
                                            }
                                        @endphp
                                        <tr class="item">
                                            <td title="" class="remove">
                                                <a onclick="return confirm('Are you sure you want to delete this?')"
                                                    href="{{ route('delete-cart', $item->id) }}">
                                                    <i class='bx bx-x'></i>
                                                </a>
                                            </td>
                                            <td title="Product">
                                                <div class="d-block">
                                                    <a
                                                        href="{{ route('productByCategory', $item->product->url_key) }}">
                                                        @if (count($item->product?->images))
                                                            <img src="{{ asset($item?->product?->images[0]->image_url) }}"
                                                                alt="" class="img-fluid d-inline-block">
                                                        @else
                                                            <img src="{{ asset('frontend/assets/images/default.png') }}"
                                                                class="img-fluid d-inline-block">
                                                        @endif
                                                    </a>
                                                    <a
                                                        href="{{ route('productByCategory', $item->product->url_key) }}">
                                                        <p class="d-inline-block">{{ $item->product?->name }}</p>
                                                    </a>
                                                </div>
                                            </td>
                                            <td title="Price">${{ $price }}</td>
                                            <td title="Quantity">
                                                <div class="quantity">
                                                    <div class="input-group-btn">
                                                        <span class="quantity-btn quantity-minus">
                                                            <i class='bx bx-minus' aria-hidden="true"></i>
                                                        </span>
                                                    </div>
                                                    <input type="number" data-price="{{ $price }}"
                                                        data-id="{{ $item->id }}"
                                                        class="input-text qty crtItmQty text quantity-{{ $item->id }}"
                                                        step="1" min="0" name=""
                                                        value="{{ $item->quantity }}" title="Qty" placeholder=""
                                                        inputmode="numeric">
                                                    <div class="input-group-btn">
                                                        <span class="quantity-btn quantity-plus">
                                                            <i class='bx bx-plus' aria-hidden="true"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td title="Subtotal" class="item-total">
                                                ${{ number_format($price * $item->quantity ?? 0, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    @endif
                </div>
                @if (!is_null($cart) && count($cart?->items) != 0)
                    <div class="container coupon_code">
                        <div class="row ">
                            <div class="col-md-7 p-0">
                                <div class="row g-3">
                                    <div class="col-sm-8 col-7">
                                        <input type="text" class="form-control w-mx-100" id="coupon_code"
                                            placeholder="Enter coupon">
                                        <p class="ms-3" style="font-size:13px;color:red;" id="coupon_err"></p>
                                    </div>
                                    <div class="col-sm-4 col-5 ps-0 text-end">
                                        <button type="button" id="coupon_apply" class="btn theme-btn mb-3">Apply
                                            Coupon</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 p-0 text-end" id="applied_coupon">
                                @if ($cart?->coupon_code)
                                    <div class="applied_coupon">
                                        <p>Applied Coupon:-
                                            <span class="coupon-applied">{{ $cart->coupon_code }}
                                                <a class="remove-coupon"
                                                    href="{{ route('coupon.remove', $cart->id) }}">
                                                    <i class='bx bx-x'></i>
                                                </a>
                                            </span>
                                        </p>
                                    </div>
                                @endif
                                {{-- <button type="submit" class="btn theme-btn mb-3 w-sm-100">Update Cart </button> --}}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="checkout-prd">
                    @if (!is_null($cart) && count($cart?->items) != 0)
                        <div class="order-summary rounded shadow">
                            <h3 class="text-center p-3 bg-light">Cart Summary</h3>
                            <input type="hidden" id="sub_total" value="{{ $cart?->total_amount }}">
                            <input type="hidden" id="tax_total" value="{{ $cart?->tax_total }}">
                            @if (!is_null($cart))
                                <input type="hidden" id="coupon" value="{{ $cart->coupon?->name }}"
                                    data-discount="{{ $cart->coupon?->discount_type_value }}"
                                    data-discount_type="{{ $cart->coupon?->discount_type }}"
                                    data-max_discount_amount="{{ $cart->coupon?->max_discount_amount }}"
                                    data-min_amount_for_discount="{{ $cart->coupon?->min_amount_for_discount }}">
                            @endif
                            <div class="row">
                                <span class="col-8">Sub Total</span>
                                <span id="sm-subtotal" class="col-4 text-right">
                                    ${{ number_format($cart->total_amount ?? 0, 2) }}
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-8">Taxable Product SubTotal</span>
                                <span id="tax-total" class="col-4 text-right">
                                    ${{ number_format($cart->tax_total ?? 0, 2) }}
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-8">Coupon Discount</span>
                                <span id="coupon-discount" class="col-4 text-right">
                                    ${{ number_format($cart->discount_amount ?? 0, 2) }}
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-8">Tax 13 %</span>
                                <span id="tax" class="col-4 text-right">
                                    ${{ number_format($cart->tax ?? 0, 2) }}</span>
                            </div>
                            <div id="grand-total-detail" class="payable-amount row">
                                <span class="col-8">Grand Total</span>
                                <span id="grand-total" class="col-4 text-right fw6">
                                    ${{ number_format($cart?->grand_total ?? 0, 2) }}
                                </span>
                            </div>
                            <div class="proceed">
                                <a href="{{ route('home') }}" class="continue-btn">
                                    Continue Shoping
                                </a>
                                <a href="{{ route('book-time') }}"
                                    class="checkout-btn {{ $cart->total_amount < 1 ? 'disabled' : '' }}">
                                    Checkout
                                </a>
                            </div>
                            @if ($cart->total_amount < 1)
                                <p class="text-danger text-end me-3 minimum-msg" style="font-size: 14px;">Minimum:
                                    $50</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <script>
            $(document).on('click', '.quantity .input-group-btn .quantity-btn', function() {
                var $input = $(this).closest('.quantity').find('.input-text');

                if ($(this).hasClass('quantity-plus')) {
                    $input.trigger('stepUp').trigger('change');
                }

                if ($(this).hasClass('quantity-minus')) {
                    if ($input.val() > 1) {
                        $input.trigger('stepDown').trigger('change');
                    }
                }
            });
            $(document).on('change', '.crtItmQty', function() {
                var totalTr = $(this).closest('.item').find('.item-total');
                var qty = $(this).val();
                var item_id = $(this).data('id');
                var item_price = $(this).data('price');
                let url = window.location.origin + "/cart/update";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        item_id: item_id,
                        qty: qty,
                        _token: "{{ csrf_token() }}" // Include CSRF token
                    },
                    success: function(response) {
                        if (response.success) {
                            hoverCartItems();
                            calculate(response.cart);
                            $('.cart_updated').show();
                            let total = qty * item_price;
                            totalTr.html('$' + total.toFixed(2));
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

            function calculate(cart) {
                $('#sm-subtotal').html('$' + cart.total_amount.toFixed(2));
                $('#sub_total').val(cart.total_amount.toFixed(2));
                $('#tax_total').val(cart.tax_total.toFixed(2));
                $('#coupon-discount').html('$' + cart.discount_amount.toFixed(2));
                $('#grand-total').html('$' + cart.grand_total.toFixed(2));
                $('#tax-total').html('$' + cart.tax_total.toFixed(2));
                $('#tax').html('$' + cart.tax.toFixed(2));
                var coupon = $('#coupon').val();
                if (coupon) {
                    var type = $('#coupon').data('discount_type');
                    var discount = $('#coupon').data('discount');
                    var min_amount_for_discount = $('#coupon').data('min_amount_for_discount');
                    var max_discount_amount = $('#coupon').data('max_discount_amount');
                    var sub_total = parseFloat($('#sub_total').val());
                    var tax_total = parseFloat($('#tax_total').val());
                    if (sub_total >= min_amount_for_discount) {
                        if (type == 1) {
                            var discount_amt = sub_total * (discount / 100);
                            if (discount_amt > max_discount_amount) {
                                discount_amt = max_discount_amount;
                            }
                            console.log(max_discount_amount, discount_amt);
                            var grand_total = sub_total - discount_amt;
                            grand_total += tax_total;
                            discount_amt = discount_amt.toFixed(2);
                            grand_total = grand_total.toFixed(2);
                            $('#coupon-discount').html('$' + discount_amt.toFixed(2));
                            $('#grand-total').html('$' + grand_total.toFixed(2));
                        } else {
                            var grand_total = sub_total - discount;
                            grand_total += tax_total;
                            grand_total = grand_total.toFixed(2);
                            $('#coupon-discount').html('$' + discount.toFixed(2));
                            $('#grand-total').html('$' + grand_total.toFixed(2));
                        }
                    } else {
                        $('#applied_coupon').html('');
                        $('#coupon').val('');
                        $('#coupon').data('discount_type', '');
                        $('#coupon').data('discount', '');
                        $('#coupon').data('min_amount_for_discount', '');
                        $('#coupon').data('max_discount_amount', '');
                    }
                }
                if (cart.total_amount > 1) {
                    $('.checkout-btn').removeClass('disabled');
                    $('.minimum-msg').hide();
                } else {
                    $('.checkout-btn').addClass('disabled');
                    $('.minimum-msg').show();
                }
            }
            $(document).on('click', '#coupon_apply', function() {
                var coupon = $('#coupon_code').val();
                if (coupon == '') {
                    $('#coupon_err').html("Coupon field can not be empty");
                    return;
                }
                let url = window.location.origin + "/coupon/apply";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        coupon: coupon,
                        _token: "{{ csrf_token() }}" // Include CSRF token
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.error) {
                                $('#coupon_err').html(response.error)
                            } else {
                                $('#coupon_err').html('');
                                $('#coupon').val(response.data.name);
                                $('#coupon').data('discount_type', response.data.discount_type);
                                $('#coupon').data('discount', response.data.discount_type_value);
                                $('#coupon').data('min_amount_for_discount', response.data
                                    .min_amount_for_discount);
                                $('#coupon').data('max_discount_amount', response.data.max_discount_amount);
                                var sub_total = parseFloat($('#sub_total').val());
                                var tax_total = parseFloat($('#tax_total').val());
                                if (response.data.discount_type == 1) {
                                    var discount_per = response.data.discount_type_value;
                                    var discount = sub_total * (discount_per / 100);
                                    if (discount > response.data.max_discount_amount) {
                                        discount = response.data.max_discount_amount;
                                    }
                                    var grand_total = sub_total - discount;
                                    grand_total += tax_total;
                                    discount = discount.toFixed(2);
                                    grand_total = grand_total.toFixed(2);
                                    $('#coupon-discount').html('$' + discount);
                                    $('#grand-total').html('$' + grand_total);
                                } else {
                                    var discount_per = response.data.discount_type_value;
                                    var discount = discount_per;
                                    var grand_total = sub_total - discount;
                                    grand_total += tax_total;
                                    discount = discount.toFixed(2);
                                    grand_total = grand_total.toFixed(2);
                                    $('#coupon-discount').html('$' + discount);
                                    $('#grand-total').html('$' + grand_total);
                                }
                                var component =
                                    '<div class="applied_coupon"><p>Applied Coupon:- <span class="coupon-applied">' +
                                    response.data.name +
                                    ' <a class="remove-coupon" href="' + window.location.origin +
                                    '/coupon/' + response.cart.id +
                                    '/remove"><i class="bx bx-x"></i></a></span></p></div>'
                                $('#applied_coupon').html(component);
                            }
                            $('#coupon_code').val('');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        </script>
        <script>
            var table = {
                mode: '',
            }

            $(document).ready(function() {
                let mode = new URLSearchParams(window.location.search).get("mode");
            });
            $('.mode').on('click', function() {
                let mode = 'grid';
                if ($(this).hasClass('grid')) {
                    mode = 'grid';
                } else {
                    mode = 'list';
                }
                table.mode = mode;
                filter('mode', mode);
            });

            function filter(key, value) {
                let uri = window.location.href
                let url = '';
                var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
                var separator = uri.indexOf('?') !== -1 ? "&" : "?";
                if (uri.match(re)) {
                    url = uri.replace(re, '$1' + key + "=" + value + '$2');
                } else {
                    url = uri + separator + key + "=" + value;
                }
                window.location.href = url;
            }
        </script>
    @endpush
</x-app-layout>
