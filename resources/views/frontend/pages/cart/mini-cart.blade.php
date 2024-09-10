<ul class="list-styled" id="hovercartItems">
    @if (!is_null($cart))
        @foreach ($cart->items as $item)
            <li class="cart-tp">
                <div class="d-flex cart___wrapper">
                    <div class="cart-image-wrapper">
                        @if (count($item->product?->images))
                            <img src="{{ asset($item->product?->images[0]?->image_url) }}" alt=""
                                class="img-fluid crt_img">
                        @else
                            <img src="{{ asset('frontend/assets/images/default.png') }}" class="img-fluid crt_img">
                        @endif
                        <div class="pct-desc">
                            <p>{{ $item->name }}</p><span>${{ $item->price }} x {{ $item->quantity }}</span>
                        </div>
                    </div>
                    <div class="d-flex qty-right">
                        <div class="qty-list input-group d-flex justify-content-end">
                            <a type="button" data-minicart="{{ true }}" data-id="{{ $item->id }}"
                                class="d-flex justify-content-center align-items-center button-minus qtyDecrement">-</a>
                            <input type="text" step="1" value="{{ $item->quantity }}" name="quantity"
                                id="quantity-{{ $item->id }}" class="quantity-field quantity-{{ $item->id }}">
                            <a type="button" data-minicart="{{ true }}" data-id="{{ $item->id }}"
                                class="d-flex justify-content-center align-items-center button-plus qtyIncrement">+</a>
                        </div>
                        <div class="price">
                            <span class="item_total">${{ $item->quantity * $item->price }}</span>
                        </div>
                        <a onclick="return confirm('Are you sure you want to delete this?')"
                            href="{{ route('delete-cart', ['id' => $item->id]) }}" class="btn remove">
                            <i class="bx bxs-message-alt-x rotate-90"></i>
                        </a>
                    </div>
                </div>
            </li>
        @endforeach
    @endif
</ul>
<p class="sub-total">Sub Total: <span class="float-end"
        id="hovercarttotal">${{ number_format($cart?->grand_total ?? 0, 2) }}</span>
</p>
<div class="row">
    <div class="col-6 text-start">
        <a href="{{ route('cart') }}" class="view-all yellow">
            View Cart
            <i class="bx bx-cart"></i>
        </a>
    </div>
    <div class="col-6 text-end">
        <a href="{{ route('book-time') }}"
            class="view-all checkout-btn {{ $cart?->total_amount < 1 ? 'disabled' : '' }}">
            Checkout
            <i class="bx bxs-arrow-to-right"></i>
        </a>
        @if ($cart?->total_amount < 1)
            <p class="text-danger minimum-msg pe-3" style="font-size: 14px;">Minimum: $50</p>
        @endif
    </div>
</div>
