<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            font-size: 12px;
            padding: 8px 12px;
            text-align: left;
        }
        .filters {
            margin-bottom: 20px;
        }
        .filters p {
            margin: 5px 0;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
        }
    </style>

</head>
<body>
    <h1>Orders Report</h1>

    <!-- Hiển thị các điều kiện lọc -->
    <div class="filters">
        <p>
            <strong>Order Code:</strong> <span style="margin-right: 20px;">{{ request()->order_number ?? 'All' }}</span>
            <strong>Phone:</strong> <span style="margin-right: 20px;">{{ request()->phone ?? 'All' }}</span>
            <strong>Status:</strong> <span style="margin-right: 20px;">{{ request()->status ?? 'All' }}</span>
            <strong>Address:</strong> <span style="margin-right: 20px;">{{ request()->shipping_address ?? 'All' }}</span>
        </p>
        <p>{{ request()->start_date ?? 'Not set date' }} <strong>to</strong> {{ request()->end_date ?? 'Not set date' }}</p>
    </div>

    <!-- Bảng dữ liệu đơn hàng -->
    <table>
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>

            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ ($order->shipping_address) }}</td>
                    <td>${{ $order->total_amount }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
