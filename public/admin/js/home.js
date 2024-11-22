

$(document).ready(function() {
    
    $('#today-div').hide();
    $('#monthly-div').show();
    $('#annual-div').hide();
    $('#all-div').hide();

    //Today
    $('#today').on('click', function() {
        $('#today-div').show();
        $('#monthly-div').hide();
        $('#annual-div').hide();
        $('#all-div').hide();

        $(this).addClass('active');
        $('#monthly').removeClass('active');
        $('#annual').removeClass('active');
        $('#all').removeClass('active');
    });

    //Monthly
    $('#monthly').on('click', function() {
        $('#today-div').hide();
        $('#monthly-div').show();
        $('#annual-div').hide();
        $('#all-div').hide();

        $(this).addClass('active');
        $('#today').removeClass('active');
        $('#annual').removeClass('active');
        $('#all').removeClass('active');
    });

    //Annual
    $('#annual').on('click', function() {
        $('#today-div').hide();
        $('#monthly-div').hide();
        $('#annual-div').show();
        $('#all-div').hide();

        $(this).addClass('active');
        $('#today').removeClass('active');
        $('#monthly').removeClass('active');
        $('#all').removeClass('active');
    });

    //All
    $('#all').on('click', function() {
        $('#today-div').hide();
        $('#monthly-div').hide();
        $('#annual-div').hide();
        $('#all-div').show();

        $(this).addClass('active');
        $('#today').removeClass('active');
        $('#monthly').removeClass('active');
        $('#annual').removeClass('active');
    });


    const dateStart = document.getElementById('date_start');
    const dateEnd = document.getElementById('date_end');

    if (dateStart && dateEnd) { 
        dateStart.addEventListener('change', updateSalesData);
        dateEnd.addEventListener('change', updateSalesData);
    }

    function updateSalesData() {
        let startDate = dateStart.value;
        let endDate = dateEnd.value;
    
        if (startDate && endDate) {
            if (startDate === endDate) {
                endDate += " 23:59:59";
            } else {
                startDate += " 00:00:00";
                endDate += " 23:59:59";
            }
    
            fetch(`/admin/get-sales-data?start_date=${startDate}&end_date=${endDate}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        document.getElementById('income-value').innerText = `$${data.income}`;
                        document.getElementById('orders-value').innerText = data.orders;
                        document.getElementById('revenue-value').innerText = `$${data.revenue}`;
                        document.getElementById('products-sold-value').innerText = data.products_sold;
    
                        const tbody = document.querySelector("#orderSearchDate tbody");
                        tbody.innerHTML = "";
                        data.filtered_orders.forEach(order => {
                            const dateObj = new Date(order.order_date);
                            const formattedDate = `${dateObj.getFullYear()}-${String(dateObj.getMonth() + 1).padStart(2, '0')}-${String(dateObj.getDate())
                                .padStart(2, '0')} ${String(dateObj.getHours()).padStart(2, '0')}:${String(dateObj.getMinutes()).padStart(2, '0')}:
                                ${String(dateObj.getSeconds()).padStart(2, '0')}`;
                            const row = `<tr>
                                <td>${order.order_number}</td>
                                <td>${order.name}</td>
                                <td>${order.phone}</td>
                                <td>${order.shipping_address}</td>
                                <td>$${order.total_amount}</td>
                                <td>${order.status}</td>
                                <td>${formattedDate}</td>
                                <td><a href="/admin/orders/detail/${order.id}" class="btn btn-info">View</a></td>
                            </tr>`;
                            tbody.insertAdjacentHTML("beforeend", row);
                        });
    
                        const labelText = `From ${startDate} to ${endDate}`;
                        document.getElementById('income-label').innerText = labelText;
                        document.getElementById('orders-label').innerText = labelText;
                        document.getElementById('revenue-label').innerText = labelText;
                        document.getElementById('products-sold-label').innerText = labelText;
                    } else {
                        alert('No data available for the selected date range.');
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }
    }
    
    
});

