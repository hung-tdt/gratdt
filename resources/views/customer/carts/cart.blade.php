
<li>
    <a href="#">
        <i class="lnr lnr-cart"></i>
        <span class="my-cart">
            <span class="total-pro">{{ $cart ? $cart->items->count() : 0 }}</span>
            <span>cart</span>
        </span>
    </a>
    <ul class="ht-dropdown cart-box-width">
        <li>
            @if($cart && $cart->items->count() > 0)
                @foreach($cart->items as $item)
                    <!-- Cart Box Start -->
                    <div class="single-cart-box">
                        <div class="cart-img">
                            <a href="/product/{{ $item->product->id }}-{{\Str::slug($item->product->name,'-')}}.html">
                                <img src="{{ $item->product->thumb }}" alt="cart-image">
                                <span class="pro-quantity">{{ $item->quantity }}</span>
                            </a>
                            
                        </div>
                        <div class="cart-content">
                            <h6>
                                <a href="/product/{{ $item->product->id }}-{{\Str::slug($item->product->name,'-')}}.html">{{ $item->product->name }}</a>
                            </h6>
                            @if ($item->product->discounted_price < $item->product->price)
                                <div style="display: flex; justify-content: space-between;">
                                    <span class="cart-price">
                                        ${{ number_format($item->product->discounted_price) }}
                                    </span>
                                    <span class="price-content" style="margin-top: 5px">
                                        ${{ number_format($item->total) }}
                                    </span>
                                </div>
                            @else
                                <div style="display: flex; justify-content: space-between;">
                                    <span class="cart-price">
                                        ${{ number_format($item->product->price) }}
                                    </span>
                                    <span class="price-content" style="margin-top: 5px">
                                        ${{ number_format($item->total) }}
                                    </span>
                                </div>
                                
                            @endif
                            
                        </div>
                       
                    </div>
                    <!-- Cart Box End -->
                @endforeach

                <!-- Cart Footer Inner Start -->
                <div class="cart-footer">
                   <ul class="price-content">
                       <li>Subtotal <span>${{ number_format($cart->items->sum('total')) }}</span></li>
                   </ul>
                    <div class="cart-actions text-center">
                        <a class="cart-checkout" href="{{ route('checkout') }}">Checkout</a>
                    </div>
                </div>
                <!-- Cart Footer Inner End -->
            @else
                <p>Your cart is empty</p>
            @endif
        </li>
    </ul>
</li>
<script>
    var checkoutUrl = "{{ route('checkout') }}";
</script>