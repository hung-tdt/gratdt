$(document).on('click', '.remove-from-wishlist', function (e) {
    e.preventDefault();  

    var productId = $(this).data('product-id'); 
    var token = $('meta[name="csrf-token"]').attr('content'); 

    var url = '/wishlist/remove/' + productId; 

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: token 
        },
        success: function (response) {
            if (response.success) {
                
                $('tr[data-product-id="' + productId + '"]').fadeOut(500, function() {
                    $(this).remove(); 
                });
                
                $('#wishlist-message').removeClass('alert-danger').addClass('alert-success').text(response.message).show();
            } else {
                $('#wishlist-message').removeClass('alert-success').addClass('alert-danger').text(response.message).show();
            }
        },
        error: function (xhr) {
            $('#wishlist-message').removeClass('alert-success').addClass('alert-danger').text('Đã xảy ra lỗi. Vui lòng thử lại.').show();
        }
    });
});
