@extends('customer.component.main')
@section('content')

<div class="coupon-container">
    <h3>Available Coupons</h3>

    @if($availableCoupons->count() > 0)
        <div class="coupon-list">
            @foreach($availableCoupons as $coupon)
                <div class="coupon-card">
                    <span class="coupon-limit">
                        {{ $coupon->max_uses }} remaining
                    </span>
                    <div class="coupon-code mt10">
                        <strong>{{ $coupon->name }}</strong>
                    </div>
                    <div class="coupon-info">
                        <span>Code: {{ $coupon->code }}</span>
                    </div>
                    <div class="coupon-info">
                        <span>Discount: 
                            @if($coupon->discount_type == 1)
                                {{ $coupon->discount_value }}%
                            @else
                                {{number_format($coupon->discount_value, 0, ',', '.'). "" }} $
                            @endif
                        </span>                   
                        
                    </div>
                    <div class="coupon-info">
                        <span>Expiry Date: {{ $coupon->expiry_date->format('d-m-Y') }}</span>
                    </div>
                    
                </div>
            @endforeach
        </div>
    @else
        <p>No available coupons at the moment.</p>
    @endif
</div>

@endsection()