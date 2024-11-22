@if($orders->count() > 0)
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->order_number }}</td>
            <td>{{ $order->order_date->format('d M Y') }}</td>
            <td>{{ $order->status }}</td>
            <td>${{ number_format($order->total_amount) }}</td>
            <td>
                <a style="font-size: 13px;" href="{{ route('order.track', ['order' => $order->id]) }}" class="btn btn-primary">Track Order</a>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center">You have no orders in this status.</td>
    </tr>
@endif