$(document).ready(function() {
    $('#searchBtn').click(function() {
        // Lấy dữ liệu từ các trường input
        var id = $('#id').val();
        var name = $('#name').val();
        var quantity_min = $('#quantity_min').val();
        var quantity_max = $('#quantity_max').val();
        var product_category_id = $('select[name="product_category_id"]').val();

        // Gửi request AJAX tới server
        $.ajax({
            url: '/admin/products/search',  // Đường dẫn đến route search
            method: 'GET',
            data: {
                id: id,
                name: name,
                quantity_min: quantity_min,
                quantity_max: quantity_max,
                product_category_id: product_category_id
            },
            success: function(response) {
                // Cập nhật bảng dữ liệu bằng phần view được trả về
                $('#productTable').html(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // Nút reset để làm trống các trường nhập liệu
    $('#resetBtn').click(function() {
        $('#id').val('');
        $('#name').val('');
        $('#quantity').val('');
        $('select[name="product_category_id"]').val('');
        
        $.ajax({
            url: '/admin/products/search',  // Đường dẫn tới route để lấy toàn bộ danh sách admin
            method: 'GET',
            data: {},  // Không gửi dữ liệu tìm kiếm để lấy toàn bộ danh sách
            success: function(response) {
                // Cập nhật bảng dữ liệu với danh sách admin ban đầu
                $('#productTable').html(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
