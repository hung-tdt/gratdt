function updateCartView(cart) {

    $('.total-pro').text(cart.items.length);

    var cartContent = '<li>'; 

    if (cart.items.length > 0) {
        cart.items.forEach(function(item) {
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
                        <span class="cart-price">$${item.total}</span>
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
        cartContent += '<p>Giỏ hàng của bạn trống</p>';
    }

    cartContent += '</li>'; 
    $('.ht-dropdown.cart-box-width').html(cartContent);
}




$(document).on('click', '.remove-item', function(e) {
    e.preventDefault();

    var itemId = $(this).data('id'); 
    var itemRow = $(this).closest('tr'); 

    $.ajax({
        url: '/cart/remove/' + itemId, 
        type: 'POST', 
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'), 
            "_method": "DELETE" 
        },
        success: function(response) {
            if (response.status === 'success') {

                itemRow.remove();
                
                $('.order-total span').text('$' + response.cartTotal);
                
                updateCartView(response.cartsmall);
            } else {
                alert(response.message);
            }
        },
        error: function() {
            alert('An error occurred. Please try again.');
        }
    });
});


$(document).ready(function() {
    $('.quantity-input').on('change', function() {
        const itemId = $(this).data('id');
        const quantity = $(this).val();

        $.ajax({
            url: `/cart/update/${itemId}`,
            type: 'POST',
            data: {
                quantity: quantity,
                _token: $('meta[name="csrf-token"]').attr('content') 
            },
            success: function(response) {
                if (response.status === 'success') {
              
                    const totalCell = $(this).closest('tr').find('.product-subtotal');
                    totalCell.text(`$${response.total}`);

              
                    $('.order-total span').text(`$${response.subtotal}`);
                    updateCartView(response.cartsmall);
                } else {
                    alert(response.message);
                    location.reload();
                }
            }.bind(this),
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    });
});

