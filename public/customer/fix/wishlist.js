$(document).ready(function () {
    $('.add-to-wishlist').on('click', function (e) {
        e.preventDefault();

        var productId = $(this).data('product-id');
        var token = $('meta[name="csrf-token"]').attr('content');

        var url = '/wishlist/add/' + productId;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: token
            },
            success: function (response) {
                if (response.success) {
                    $('#wishlist-message').removeClass('alert-danger').addClass('alert-success').text(response.message).show();
                } else {
                    $('#wishlist-message').removeClass('alert-success').addClass('alert-danger').text(response.message).show();
                }

          
                setTimeout(function() {
                    $('#wishlist-message').fadeOut(500); 
                }, 3000);
            },
            error: function (xhr) {
                $('#wishlist-message').removeClass('alert-success').addClass('alert-danger').text('Đã xảy ra lỗi. Vui lòng thử lại.').show();
                setTimeout(function() {
                    $('#wishlist-message').fadeOut(500);
                }, 3000);
            }
        });
    });
});


