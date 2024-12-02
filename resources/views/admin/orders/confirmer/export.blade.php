<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif; /* Sử dụng font hỗ trợ tiếng Việt */
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Order #{{ $order->order_number }}</h1>
    <p class="mt22" style="display: flex; gap: 100px;">
        <span><strong>Customer:</strong> {{ $order->name }}, </span>
        <span><strong>User name:</strong> {{ $order->username }}</span>
    </p>
    <p class="mt22" style="display: flex; gap: 70px;">
        <span><strong>Phone:</strong> {{ $order->phone }}, </span>
        <span><strong>Email:</strong> {{ $order->email }}</span>
    </p>
    <p class="mt22" style="display: flex; gap: 70px;">
        <span><strong>Payment status:</strong> {{ $order->payment_status }}, </span>
        <span><strong>Payment method:</strong> {{ $order->payment_method }}, </span>
        <span><strong>Total Amount:</strong>${{number_format($order->total_amount, 0, ',', '.'). "" }}</span>
    </p>
    <p class="mt22"><strong>Notes:</strong>{{ $order->notes }} </p>
    <p class="mt22"><strong>Order Date:</strong> {{ $order->order_date }}</p>
    <p class="mt22"><strong>Billing address:</strong> {{ $order->billing_address }}</p>
    <p class="mt22"><strong>Shipping address:</strong> {{ $order->shipping_address }}</p>

    <h3>Order Items</h3>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>${{ number_format($detail->price, 0, ',', '.') }}</td>
                    <td>${{ number_format($detail->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Total</th>
                <td>${{ number_format($order->total_amount + $order->discount) }}</td>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Discount</th>
                <td>- ${{ number_format($order->discount) }}</td>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Total Amount</th>
                <td>${{ number_format($order->total_amount) }}</td>
            </tr>
        </tfoot>
    </table>

    <h3>Total Amount: ${{ number_format($order->total_amount, 0, ',', '.') }}</h3>
</body>
</html>
