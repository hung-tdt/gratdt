@extends('customer.component.main')

@section('content')

<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="index.html">Home</a></li>
                <li class="active"><a href="checkout.html">Checkout</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<div class="breadcrumb-area mt-30">
    <div class="container">		
        @include('admin.component.alert')
    </div>
</div>

<!-- coupon-area start -->
<div class="coupon-area pt-100 pt-sm-60">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="coupon-accordion">
                    <!-- ACCORDION START -->
                    <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                    <div id="checkout_coupon" class="coupon-checkout-content">
                        <div class="coupon-info">
                            <form action="#">
                                <p class="checkout-coupon">
                                    <input type="text" class="code" placeholder="Coupon code">
                                    <input type="submit" value="Apply Coupon">
                                </p>
                            </form>
                        </div>
                    </div>
                    <!-- ACCORDION END -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- coupon-area end -->
<!-- checkout-area start -->
<form action="{{ route('placeOrder') }}" method="POST">
    @csrf
    <!-- Dữ liệu địa chỉ -->
    <input type="hidden" name="name" value="{{ $customer->name }}">
    <input type="hidden" name="username" value="{{ $customer->username }}">
    <input type="hidden" name="phone" value="{{ $customer->phone }}">
    <input type="hidden" name="email" value="{{ $customer->email }}">
    <input type="hidden" name="billing_address" value="tdt, vinh, nghệ an">
    <input type="hidden" name="shipping_address" 
    value="{{ $customer->address }}, {{ $customer->ward->full_name }}, {{ $customer->district->full_name }}, {{ $customer->province->full_name }}">
    <div class="checkout-area pb-100 pt-15 pb-sm-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form mb-sm-40">
                        <h3>Billing Details</h3>
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-sm-30">
                                    <label>Name <span class="required">*</span></label>
                                    <input type="text" placeholder="" value="{{ $customer->name }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>User Name <span class="required">*</span></label>
                                    <input type="text" placeholder="" value="{{ $customer->username }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" placeholder="" value="{{ $customer->email }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Phone  <span class="required">*</span></label>
                                    <input type="text" placeholder="" value="{{ $customer->phone }}" disabled>
                                </div>
                            </div>                            

                            <div class="col-md-4">
                                <div class="checkout-form-list">
                                    <label>Province</label>
                                    <input type="text" value="{{ $customer->province->full_name }}" disabled>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="checkout-form-list">
                                    <label>District</label>
                                    <input type="text" value="{{ $customer->district->full_name }}" disabled>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="checkout-form-list">
                                    <label>Ward</label>
                                    <input type="text" value="{{ $customer->ward->full_name }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-12 mt10">
                                <div class="checkout-form-list">
                                    <label>Address <span class="required">*</span></label>
                                    <input type="text" name="address" placeholder="Street address" value="{{ $customer->address }}" disabled>
                                </div>
                            </div>          
                            
                        </div>
                        <div class="different-address mt10">
                            <div class="ship-different-title">
                                <h3>
                                    <label>Ship to a different address?</label>
                                    <!-- Checkbox với name để gửi dữ liệu -->
                                    <input id="ship-box" type="checkbox" name="shipToDifferentAddress" value="1">
                                </h3>
                            </div>
                            <div id="ship-box-info" style="display: none;">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>Name <span class="required">*</span></label>
                                            <input type="text" name="other_name" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>User Name <span class="required">*</span></label>
                                            <input type="text" name="other_username" placeholder="">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>Email <span class="required">*</span></label>
                                            <input type="email" name="other_email" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>Phone  <span class="required">*</span></label>
                                            <input type="text" name="other_phone" placeholder="">
                                        </div>
                                    </div>

                                    
                                        <!-- Province -->
                                    <div class="col-md-4">
                                        <div class="address-fname">
                                            <select name="province_id" id="province" class="form-control">
                                                <option value="">Select Province/City</option>
                                                @foreach($provinces as $province)
                                                    <option value="{{ $province->id }}">{{ $province->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
            
                                    <!-- District -->
                                    <div class="col-md-4">
                                        <div class="address-fname">
                                            <select name="district_id" id="district" class="form-control" style="display: none;">
                                                <option value="">Select district</option>
                                            </select>
                                        </div>
                                    </div>
            
                                    <!-- Ward -->
                                    <div class="col-md-4">
                                        <div class="address-fname">
                                            <select name="ward_id" id="ward" class="form-control" style="display: none;">
                                                <option value="">Select Ward</option>
                                            </select>
                                        </div>
                                    </div>        
                                    
                                    <div class="col-md-12 mt10">
                                        <div class="checkout-form-list mb-30">
                                            <label>Address <span class="required">*</span></label>
                                            <input type="text" name="other_address" placeholder="Enter specific address">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="order-notes">
                                <div class="checkout-form-list">
                                    <label>Order Notes</label>
                                    <textarea id="checkout-mess" name="notes" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="your-order">
                        <h3>Your order</h3>
                        <div class="your-order-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart->items as $item)
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            {{ $item->product->name }} <span class="product-quantity"> × {{ $item->quantity }}</span>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">${{ number_format($item->total) }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount">${{ number_format($subtotal) }}</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><span class=" total amount">${{ number_format($subtotal) }}</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        @foreach($cart->items as $item)
                                        <input type="hidden" name="cart_items[{{ $loop->index }}][product_id]" value="{{ $item->product->id }}">
                                        <input type="hidden" name="cart_items[{{ $loop->index }}][quantity]" value="{{ $item->quantity }}">
                                        <input type="hidden" name="cart_items[{{ $loop->index }}][price]" value="{{ $item->price }}">
                                        <input type="hidden" name="cart_items[{{ $loop->index }}][total]" value="{{ $item->quantity * $item->price }}">
                                        @endforeach
                                
                                        <td><button class="place_order" type="submit">Place Order</button></td>

                                        <td><button name="redirect" class="place_order" type="submit" form="vnpay_payment_form">Payment</button></td>
                                    </tr>

                                </tfoot>            
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</form>
<!-- checkout-area end -->
<form id="vnpay_payment_form" action="{{ url('/vnpay_payment') }}" method="POST">
    @csrf
    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
</form>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/customer/fix/addressedit.js"></script>


