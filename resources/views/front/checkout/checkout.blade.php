@extends('front.layout.master')
@section('content')
    <!-- Shopping Cart  Section Begin -->
    <div class="checkout-section spad">
        <div class="container">
            @if (count($cart) > 0)
                <form action="" method="post" class="checkout-form">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="checkout-content">
                                @if (!Auth::check())
                                    <a href="{{ route('login.index') }}" class="content-btn">Click Here To Login</a>
                                @endif
                            </div>
                            {{-- <input name="user_id" type="text" style="visibility: hidden;"
                                value="{{ Auth::user()->id ?? '' }}"> --}}
                            <h4>Biiling Details</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="fir">First Name <span>*</span></label>
                                    <input required name="first_name" type="text" id="fir"
                                        value="{{ Auth::user()->name ?? '' }}">
                                </div>
                                <div class="col-lg-6">
                                    <label for="last">Last Name <span>*</span></label>
                                    <input required name="last_name" type="text" id="last">
                                </div>
                                <div class="col-lg-12">
                                    <label for="cun">Country<span>*</span></label>
                                    <input required name="country" type="text" id="cun"
                                        value="{{ Auth::user()->country ?? '' }}">
                                </div>
                                <div class="col-lg-12">
                                    <label for="street">Street Address<span>*</span></label>
                                    <input required name="street_address" type="text" id="street" class="street-first"
                                        value="{{ Auth::user()->street_address ?? '' }}">
                                </div>
                                <div class="col-lg-12">
                                    <label for="zip">Postcode / ZIP (optinal)</label>
                                    <input required name="postcode_zip" type="text" id="zip"
                                        value="{{ Auth::user()->postcode_zip ?? '' }}">
                                </div>
                                <div class="col-lg-12">
                                    <label for="town">Town / CITY <span>*</span></label>
                                    <input required name="town_city" type="text" id="town"
                                        value="{{ Auth::user()->town_city ?? '' }}">
                                </div>
                                <div class="col-lg-12">
                                    <label for="email">Email Address <span>*</span></label>
                                    <input required name="email" type="text" id="email"
                                        value="{{ Auth::user()->email ?? '' }}">
                                </div>
                                <div class="col-lg-12">
                                    <label for="phone">Phone <span>*</span></label>
                                    <input required name="phone" type="text" id="phone"
                                        value="{{ Auth::user()->phone ?? '' }}">
                                </div>

                                <div class="col-lg-12">
                                    <div class="create-item">
                                        <label for="acc-create">
                                            Create an account?
                                            <input type="checkbox" id="acc-create">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkout-content" style="visibility: hidden;">
                                <input type="text" placeholder="Enter Your Coupon Code">
                            </div>
                            <div class="place-order">
                                <h4>Your Order</h4>
                                <div class="order-total">
                                    <ul class="order-table">
                                        <li>Product <span>Total</span></li>
                                        @foreach ($cart as $item)
                                            <li class="fw-normal">{{ $item->name }} x {{ $item->qty }}
                                                <span>${{ $item->total }}</span>
                                            </li>
                                        @endforeach
                                        <li class="fw-normal">Subtotal <span>${{ $subTotal }}</span></li>
                                        <li class="total-price">Total <span>${{ $subTotal }}</span></li>
                                    </ul>
                                    <div class="payment-check">
                                        <div class="pc-item">
                                            <label for="pc-check">
                                                Pay later
                                                <input name="payment_type" value="pay_later" type="radio" id="pc-check">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="pc-item">
                                            <label for="pc-paypal">
                                                Pay Online
                                                <input name="payment_type" value="pay_online" type="radio" id="pc-paypal">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="order-btn">
                                        <button type="submit" class="site-btn place-btn">Place Order</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            @else
                <div class="col-lg-12">
                    <img style="margin: auto;" src="front/img/empty-cart.webp" alt="">
                </div>
            @endif
        </div>
    </div>
    <!-- Shopping Cart  Section Begin -->
@endsection
