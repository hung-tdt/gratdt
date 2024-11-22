$(document).ready(function() {
    
    $('#searchBtn-pending').click(function() {
        filterOrders('Pending');
    });

    $('#searchBtn-confirmed').click(function() {
        filterOrders('orderconfirmed');
    });

    $('#searchBtn-shipping').click(function() {
        filterOrders('shipping');
    });

    $('#searchBtn-received').click(function() {
        filterOrders('received');
    });

    $('#searchBtn-cancelled').click(function() {
        filterOrders('cancelled');
    });

    $('#resetBtn').click(function() {
        filterOrders('');
    });

    function filterOrders(status) {
        $.ajax({
            url: '/orders/filter',
            method: 'GET',
            data: { status: status },
            success: function(response) {
               
                $('tbody').html(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
});
