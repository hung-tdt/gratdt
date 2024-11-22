$(function() {

    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 1000,
        values: [0, 1000],
        slide: function(event, ui) {
            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);

            $.ajax({
                url: "/filter-by-price", 
                method: "GET", 
                data: {
                    min_price: ui.values[0], 
                    max_price: ui.values[1]  
                },
                success: function(response) {
                    $('#productResults').html(response);
                }
            });
        }
    });

    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
        " - $" + $("#slider-range").slider("values", 1));
});