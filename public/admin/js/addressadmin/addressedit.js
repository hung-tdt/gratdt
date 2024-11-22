$(document).ready(function() {
    // Xử lý khi chọn lại tỉnh/thành phố
    $('#province').on('change', function() {
        var provinceId = $(this).val();
        if (provinceId) {
            $.ajax({
                url: '/admin/get-districts/' + provinceId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#district').empty().append('<option value="">Select District</option>');
                    $('#ward').empty().append('<option value="">Select Ward</option>'); 
                    $.each(data, function(key, value) {
                        $('#district').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                    $('#district').show();
                }
            });
        } else {
            $('#district').empty().append('<option value="">Select District</option>');
            $('#ward').empty().append('<option value="">Select Ward</option>');
        }
    });

    // Xử lý khi chọn lại quận/huyện
    $('#district').on('change', function() {
        var districtId = $(this).val();
        if (districtId) {
            $.ajax({
                url: '/admin/get-wards/' + districtId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#ward').empty().append('<option value="">Select Ward</option>');
                    $.each(data, function(key, value) {
                        $('#ward').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                    $('#ward').show();
                }
            });
        } else {
            $('#ward').empty().append('<option value="">Select Ward</option>');
        }
    });
});
