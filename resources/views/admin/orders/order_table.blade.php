<thead>
    <tr>
        <th>Order Number</th>
        <th>Customer</th>
        <th>Phone</th>
        <th style="width: 300px">Address</th>
        <th>Total Amount</th>
        <th>Status</th>
        <th>Order Date</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->order_number }}</td>
            <td>{{ $order->name }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ $order->shipping_address }}</td>
            <td>${{ $order->total_amount }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->order_date }}</td>
            <td>
                <a href="{{ route('orders.detail', $order->id) }}" class="btn btn-info">View</a>
            </td>
        </tr>
    @endforeach
</tbody>