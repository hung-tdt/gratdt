$(document).ready(function() {
    $('#searchBtn').click(function() {
        // Lấy dữ liệu từ các trường input
        var title = $('#title').val();
        var abstract = $('#abstract').val();
        var author = $('#author').val();
        var post_category_id = $('select[name="post_category_id"]').val();

        // Gửi request AJAX tới server
        $.ajax({
            url: '/admin/posts/search',  // Đường dẫn đến route search
            method: 'GET',
            data: {
                title: title,
                abstract: abstract,
                author: author,
                post_category_id: post_category_id
            },
            success: function(response) {
                // Cập nhật bảng dữ liệu bằng phần view được trả về
                $('#postTable').html(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // Nút reset để làm trống các trường nhập liệu
    $('#resetBtn').click(function() {
        $('#title').val('');
        $('#abstract').val('');
        $('#author').val('');
        $('select[name="post_category_id"]').val('');
        
        $.ajax({
            url: '/admin/posts/search',  // Đường dẫn tới route để lấy toàn bộ danh sách admin
            method: 'GET',
            data: {},  // Không gửi dữ liệu tìm kiếm để lấy toàn bộ danh sách
            success: function(response) {
                // Cập nhật bảng dữ liệu với danh sách admin ban đầu
                $('#postTable').html(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
