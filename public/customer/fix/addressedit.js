$(document).ready(function() {

    $('#province').on('change', function() {
        var provinceId = parseInt($(this).val(), 10); 
        
        if (provinceId) {
            $.ajax({
                url: '/get-districts/' + provinceId, 
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#district').niceSelect('destroy');
    
                    $('#district').empty().append('<option value="">Chọn Quận/Huyện</option>');
                    $.each(data, function(key, value) {
                        $('#district').append('<option value="'+ key +'">'+ value +'</option>');
                    });

                    $('#district').niceSelect(); 
                },
                error: function(xhr, status, error) {
                    console.log('Lỗi: ' + error);
                }
            });
        } else {
            $('#district').empty().append('<option value="">Chọn Quận/Huyện</option>');
            $('#ward').empty().append('<option value="">Chọn Xã/Phường</option>');
        }
    });

    $('#district').on('change', function() {
        var districtId = parseInt($(this).val(), 10);
        if (districtId) {
            $.ajax({
                url: '/get-wards/' + districtId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#ward').empty().append('<option value="">Chọn Xã/Phường</option>');
                    $.each(data, function(key, value) {
                        $('#ward').append('<option value="'+ key +'">'+ value +'</option>');
                    });

                    $('#ward').niceSelect('destroy');
                    $('#ward').niceSelect();
                },
                error: function(xhr, status, error) {
                    console.log('Lỗi: ' + error);
                }
            });
        } else {
            $('#ward').empty().append('<option value="">Chọn Xã/Phường</option>');
        }
    });
});
