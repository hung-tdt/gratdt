$(document).ready(function() {
    $('#searchBtn').click(function() {
        // Lấy dữ liệu từ các trường input
        var order_number = $('#order_number').val();
        var status = $('#status').val();
        var phone = $('#phone').val();
        var shipping_address = $('#shipping_address').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
    
        // Gửi request AJAX tới server
        $.ajax({
            url: '/admin/orders/search',  // Đường dẫn đến route search
            method: 'GET',
            data: {
                order_number: order_number,
                status: status,
                phone: phone,
                shipping_address: shipping_address,
                start_date: start_date,
                end_date: end_date
            },
            success: function(response) {
                // Cập nhật bảng dữ liệu bằng phần view được trả về
                $('#orderTable').html(response);
                
                // Cập nhật URL cho nút export PDF
                var exportPdfUrl = '/admin/orders/export-pdf?order_number=' + order_number + '&status=' + status + '&phone=' + phone + '&shipping_address=' + shipping_address + '&start_date=' + start_date + '&end_date=' + end_date;
                $('#exportPdfBtn').attr('href', exportPdfUrl);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
    
    // Nút reset để làm trống các trường nhập liệu
    $('#resetBtn').click(function() {
        $('#order_number').val('');
        $('#status').val('');
        $('#phone').val('');
        $('#shipping_address').val('');
        $('#start_date').val('');
        $('#end_date').val('');
        
        $.ajax({
            url: '/admin/orders/search',  // Đường dẫn tới route để lấy toàn bộ danh sách admin
            method: 'GET',
            data: {},  // Không gửi dữ liệu tìm kiếm để lấy toàn bộ danh sách
            success: function(response) {
                // Cập nhật bảng dữ liệu với danh sách admin ban đầu
                $('#orderTable').html(response);
                
                // Cập nhật URL cho nút export PDF
                $('#exportPdfBtn').attr('href', '/admin/orders/export-pdf');
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});