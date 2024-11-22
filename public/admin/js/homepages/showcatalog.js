
$(document).ready(function () {
    $('#update-button').click(function (e) {
        e.preventDefault();

        // Serialize form data
        let formData = $('#update-form').serialize();

        $.ajax({
            url: "/admin/manage-homepage/update-categories-status",
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                } else {
                    alert('Something went wrong. Please try again.');
                }
            },
            error: function (error) {
                alert('Error updating categories.');
            }
        });
    });
});
