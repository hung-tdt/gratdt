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
                        <strong>{{ $coupon->code }}</strong>
                    </div>
                    <div class="coupon-info">
                        <span>Discount: 
                            @if($coupon->discount_type == 1)
                                {{ $coupon->discount_value }}%
                            @else
                                {{number_format($coupon->discount_value, 0, ',', '.'). "" }} $
                            @endif
                        </span>
                        <br>
                        <span>Expiry Date: {{ $coupon->expiry_date->format('d-m-Y') }}</span>
                    </div>
                    <div class="coupon-action">
                        @if(!$coupon->savedByUser(auth()->user()))
                            <form action="{{ route('coupons.save') }}" method="POST">
                                @csrf
                                <input type="hidden" name="coupon_code" value="{{ $coupon->code }}">
                                <button type="submit" class="save-btn">Save this Coupon</button>
                            </form>
                        @else
                            <span class="saved-msg">You have already saved this coupon.</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No available coupons at the moment.</p>
    @endif
</div>

@endsection()