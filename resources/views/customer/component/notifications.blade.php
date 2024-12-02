@extends('customer.component.main') 


@section('content')

<div class="container notification-container">
    <h1>Your notifications</h1>
    @if ($notifications->count())
        <ul>
            @foreach ($notifications as $notification)
                <li class="notification-item">
                    @if (isset($notification->data['order_id']))
                        <a href="{{ url('order-track/' . $notification->data['order_id']) }}" class="notification-link">
                            {{ $notification->data['message'] }}
                        </a>
                    @else
                        <span class="notification-link">
                            {{ $notification->data['message'] }}
                        </span>
                    @endif
                </li>
            @endforeach
        </ul>

    @else
        <p>There are no notifications.</p>
    @endif
</div>
@endsection
<link rel="stylesheet" href="customer\fix\notification.css">

