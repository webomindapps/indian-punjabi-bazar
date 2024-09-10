window.addEventListener('click', function (event) {
    var searchDiv = document.getElementById('search-div');
    var searchInput = document.getElementById('search-input');
    var isClickInsideSearch = searchDiv.contains(event.target) || event.target === searchInput;

    if (!isClickInsideSearch) {
        $('.search-results').hide();
    }
});

$(document).ready(function () {
    hoverCartItems();
});

function hoverCartItems(update = false) {
    let url = window.location.origin + "/cart-items";

    if (!update) {
        hideMiniCart();
    }

    $.ajax({
        type: "GET",
        url: url,
        success: function (response) {
            if (response.count > 0) {
                if (!update) {
                    showMiniCart();
                }
                $("#hovedCart").html("");
                $("#hovedCart").append(response.html);
                $("#item-count").text(response.count);
                $("#item-count-sm").text(response.count);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        },
        complete: function () {
            $(".enquire-btn").prop("disabled", false);
        },
    });
}

$(document).on("click", ".addToCart", function () {
    let product_id = $(this).data("id");
    let qty = $(`#quantity-${product_id}`).val();
    addToCart(product_id, qty);
});

$(document).on("click", ".qtyIncrement", function () {
    var id = $(this).data("id");
    let isMiniCart = $(this).data("minicart");
    let currentValue = $(`#quantity-${id}`).val();
    $(`.quantity-${id}`).val(parseInt(currentValue) + 1);
    $(`.quantity-${id}`).trigger('change');

    if (isMiniCart) {
        updateCart(id, $(`#quantity-${id}`).val());
    }
});

$(document).on("click", ".qtyDecrement", function () {
    var id = $(this).data("id");
    let isMiniCart = $(this).data("minicart");
    let currentValue = $(`#quantity-${id}`).val();

    if (currentValue > 1) {
        $(`.quantity-${id}`).val(parseInt(currentValue) - 1);
        $(`.quantity-${id}`).trigger('change');
    }

    if (isMiniCart) {
        updateCart(id, $(`#quantity-${id}`).val());
    }
});

const showMiniCart = () => {
    $("#miniCart").addClass("v_cart");
};

const hideMiniCart = () => {
    $("#miniCart").removeClass("v_cart");
};

const addToCart = (id, qty) => {
    let url = window.location.origin + "/add/cart";
    $.ajax({
        type: "POST",
        url: url,
        data: {
            product_id: id,
            qty: qty,
            _token: document.querySelector('meta[name="csrf-token"]').content,
        },
        success: function (response) {
            if (response.success) {
                hoverCartItems();
                $("#quantity").val(1);
                window.FlashMessage.info('Item was successfully added to the cart', {
                    timeout: 2000,
                    progress: true
                });
            } else {
                window.FlashMessage.error('Stock not Available', {
                    timeout: 2000,
                    progress: true
                });
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        },
        complete: function () {
            $(".enquire-btn").prop("disabled", false);
        },
    });
};

const updateCart = (id, qty) => {
    let url = window.location.origin + "/cart/update";
    $.ajax({
        type: "POST",
        url: url,
        data: {
            item_id: id,
            qty: qty,
            _token: document.querySelector('meta[name="csrf-token"]').content,
        },
        success: function (response) {
            hoverCartItems(true);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        },
        complete: function () {
            $(".enquire-btn").prop("disabled", false);
        },
    });
};
