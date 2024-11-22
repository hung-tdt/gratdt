$(document).ready(function() {
    $('#searchBtn').click(function() {
        // Lấy dữ liệu từ các trường input
        var name = $('#name').val();
        var username = $('#username').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var role_id = $('select[name="role_id"]').val();

        // Gửi request AJAX tới server
        $.ajax({
            url: '/admin/admins/search',  // Đường dẫn đến route search
            method: 'GET',
            data: {
                name: name,
                username: username,
                phone: phone,
                email: email,
                role_id: role_id
            },
            success: function(response) {
                // Cập nhật bảng dữ liệu bằng phần view được trả về
                $('#adminTable').html(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // Nút reset để làm trống các trường nhập liệu
    $('#resetBtn').click(function() {
        $('#name').val('');
        $('#username').val('');
        $('#phone').val('');
        $('#email').val('');
        $('select[name="role_id"]').val('');
        
        $.ajax({
            url: '/admin/admins/search',  // Đường dẫn tới route để lấy toàn bộ danh sách admin
            method: 'GET',
            data: {},  // Không gửi dữ liệu tìm kiếm để lấy toàn bộ danh sách
            success: function(response) {
                // Cập nhật bảng dữ liệu với danh sách admin ban đầu
                $('#adminTable').html(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});