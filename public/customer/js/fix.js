// function placeOrder() {
//     products.forEach(function(product) {
//         $.ajax({
//             url: "{{ route('increaseSoldCount') }}",
//             method: "POST",
//             data: {
//                 product_id: product.id
//             },
//             success: function(response) {
//                 if (response.success) {
//                     console.log('Sold count increased for product with ID: ' + product.id);
//                 } else {
//                     console.log('Failed to increase sold count for product with ID: ' + product.id);
//                 }
//             },
//             error: function() {
//                 console.log('An error occurred while making the request for product with ID: ' + product.id);
//             }
//         });
//     });

// }
// $('#checkoutButton').click(function() {
//     placeOrder();
// });