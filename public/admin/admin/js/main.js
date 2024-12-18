$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url) {
    if (confirm('xóa mà không thể khôi phục, bạn có chắc?')) 
    {
        $.ajax({
            type: 'DELETE',
            datatype:'JSON',
            data: {id},
            url: url,
            success: function(result) {
                if(result.error == false)
                {
                    alert(result.message);
                    location.reload();
                }else {
                    alert('xóa lỗi, vui lòng thử lại');
                }
            }

        })
    }
}


/*Upload file*/
$('#upload').change(function (){
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData : false,
        contentType : false,
        type        : 'POST',
        dataType    : 'JSON',
        data        : form,
        url  : '/admin/upload/services',
        success: function(results) {
            if(results.error == false)
            {
                $('#image_show').html('<a href="' + results.url + '" target = "_blank">' +
                        '<img src="' + results.url + '" width="200px"></a>');

                $('#thumb').val(results.url);
            }else {
                alert('upload file lỗi');
            }
        }
    });
});

