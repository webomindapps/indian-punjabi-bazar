@props(['id'])

<div class="qty-list input-group align-self-end ">
    <a type="button" data-id="{{ $id }}"
        class="d-flex justify-content-center align-items-center button-minus qtyDecrement">-</a>
    <input type="text" step="1" value="1" name="quantity" id="quantity-{{ $id }}"
        class="quantity-field quantity-{{ $id }}">
    <a type="button" data-id="{{ $id }}"
        class="d-flex justify-content-center align-items-center button-plus qtyIncrement">+</a>
</div>
{{-- @props(['id'])


<div class="product_option">
    <div class="inputs-group button-group">
        <div class="input-group">
            <div class="qty-list input-group align-self-center ">
                <a type="button" data-id="{{ $id }}"
                    class="d-flex justify-content-center align-items-center button-minus qtyDecrement">-</a>
                <input type="text" step="1" value="1" name="quantity" id="quantity-{{ $id }}"
                    class="quantity-field quantity-{{ $id }}">
                <a type="button" data-id="{{ $id }}"
                    class="d-flex justify-content-center align-items-center button-plus qtyIncrement">+</a>
            </div>
        </div>
    </div>
    <a href="" class="add_inner "><i class='bx bx-cart-add'></i></a>
    <a class="addToCart add_inner " data-id="{{ $id }}">
        <i class='bx bx-cart-add'></i>
    </a>
</div> --}}
