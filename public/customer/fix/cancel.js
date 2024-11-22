

$(document).ready(function() {
    $('#cancelOrderBtn').click(function() {
        var orderId = $(this).data('id'); 
        var token = $('meta[name="csrf-token"]').attr('content'); 
        
        if (confirm('Are you sure you want to cancel this order?')) {
            $.ajax({
                url: '/order/cancel/' + orderId,  
                type: 'POST',
                data: {
                    _token: token 
                },
                success: function(response) {
                    if (response.success) {
                        
                        $('#wishlist-message').removeClass('alert-danger').addClass('alert-success').text(response.message).show();
                        setTimeout(function() {
                            window.location.href = '/order-history'; 
                        }, 2000);
                    } else {
                        $('#wishlist-message').removeClass('alert-success').addClass('alert-danger').text(response.message).show();
                    }

                    
                    setTimeout(function() {
                        $('#wishlist-message').fadeOut(500);
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    $('#wishlist-message').removeClass('alert-success').addClass('alert-danger').text('An error occurred. Please try again.').show();
                    setTimeout(function() {
                        $('#wishlist-message').fadeOut(500);
                    }, 3000);
                }
            });
        }
    });
});
