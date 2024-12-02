function updateCartView(cart) {

    $('.total-pro').text(cart.items.length);

    var cartContent = '<li>'; 

    if (cart.items.length > 0) {
        cart.items.forEach(function(item) {
            var price = item.price;
            var total = item.total;
            var priceHtml = `
                <div style="display: flex; justify-content: space-between;">
                    <span class="cart-price">$${price.toFixed(2)}</span>
                    <span class="price-content" style="margin-top: 5px">$${total.toFixed(2)}</span>
                </div>
            `;
            cartContent += `
                <div class="single-cart-box">
                    <div class="cart-img">
                        <a href="/product/${item.product.id}-${item.product.name.replace(/ /g, '-').toLowerCase()}.html">
                            <img src="${item.product.thumb}" alt="cart-image">
                            <span class="pro-quantity">${ item.quantity }</span>
                        </a>
                    </div>
                    <div class="cart-content">
                        <h6>
                            <a href="/product/${item.product.id}-${item.product.name.replace(/ /g, '-').toLowerCase()}.html">${item.product.name}</a>
                        </h6>
                        ${priceHtml}
                    </div>
                    
                </div>
            `;
        });

        cartContent += `
            <div class="cart-footer">
                <ul class="price-content">
                    <li>Subtotal <span>$${cart.items.reduce((acc, item) => acc + item.total, 0)}</span></li>
                </ul>
                <div class="cart-actions text-center">
                    <a class="cart-checkout" href="${checkoutUrl}">Checkout</a>
                </div>
            </div>
        `;
    } else {
        cartContent += '<p>Your cart is empty</p>';
    }

    cartContent += '</li>'; 

    $('.ht-dropdown.cart-box-width').html(cartContent);
}

$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.add-to-cart-button').on('click', function(e) {
        e.preventDefault();

        var productId = $(this).data('product-id');
        var quantity = $(this).data('quantity') || $('#num_product').val() / 2; 

        $.ajax({
            url: '/addcart',
            method: 'POST',
            data: {
                product_id: productId,
                num_product: quantity,
                _token: $('meta[name="csrf-token"]').attr('content') // 
            },
            success: function(response) {
                const $messageBox = $('#wishlist-message');

                if (response.success) {
                    $messageBox.removeClass('alert-danger').addClass('alert-success').text(response.message).show();
                } else {
                    $messageBox.removeClass('alert-success').addClass('alert-danger').text(response.message).show();
                }
                
                if (window.messageTimeout) {
                    clearTimeout(window.messageTimeout);
                }

                window.messageTimeout = setTimeout(function() {
                    $messageBox.fadeOut(500);
                }, 2000);

                updateCartView(response.cart);
            },
            error: function(xhr, status, error) {
                $('#wishlist-message').removeClass('alert-success').addClass('alert-danger').text('An error occurred. Please try again.').show();
                setTimeout(function() {
                    $('#wishlist-message').fadeOut(500);
                }, 3000);
            }
        });
    });
});

