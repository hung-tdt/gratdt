document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('applyCouponBtn').addEventListener('click', function () {
        const couponCode = document.getElementById('code').value;
        const subtotal = parseFloat(document.getElementById('couponData').dataset.subtotal);

        if (!couponCode) {
            alert('Please enter a coupon code.');
            return;
        }
        fetch(applyCouponUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ code: couponCode, subtotal: subtotal })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => { throw new Error(data.error); });
            }
            return response.json();
        })
        .then(data => {
            
            document.querySelector('.cart-subtotal .discount').textContent = `-$${data.discount.toFixed(2)}`;
            document.querySelector('.order-total .total.amount').textContent = `$${data.total.toFixed(2)}`;

            document.querySelector('input[name="discount"]').value = data.discount;
        })
        .catch(error => {
            alert(error.message);
        });
    });
});
