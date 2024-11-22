
/*Upload file*/
$(document).on('change', '#upload', function() {
    console.log('File input changed');
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/uploadcus/services',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
        },
        success: function (results) {
            if (results.error == false) {
                $('#image_show').html('<a href="' + results.url + '" target="_blank">' +
                    '<img src="' + results.url + '" width="120px"></a>');
                $('#thumb').val(results.url);
            } else {
                alert('Lỗi tải lên file');
            }
        },
        error: function (xhr) {
            alert('Có lỗi xảy ra: ' + xhr.statusText);
        }
    });
});

