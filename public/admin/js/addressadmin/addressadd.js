$(document).ready(function() {
    // Khi người dùng chọn Tỉnh/Thành phố
    $('#province').on('change', function() {
        var provinceId = $(this).val();
        if (provinceId) {
            $.ajax({
                url: '/admin/get-districts/' + provinceId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#district').empty().append('<option value="">Select District</option>');
                    $('#ward').empty().append('<option value="">Select Ward</option>'); // Reset ward
                    $.each(data, function(key, value) {
                        $('#district').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                    $('#district').show(); // Hiển thị dropdown huyện
                }
            });
        } else {
            $('#district').empty().append('<option value="">Select District</option>').hide();
            $('#ward').empty().append('<option value="">Select Ward</option>').hide();
        }
    });

    // Khi người dùng chọn Quận/Huyện
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
            $('#ward').empty().append('<option value="">Select Ward</option>').hide();
        }
    });
});
