@extends('front.layout.master')
@section('title')
    Cart
@endsection
@section('content')
    <!-- Breadcrumb section begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{ route('home.index') }}"><i class="fa fa-home"></i>Home</a>
                        <a href="{{ route('shop.index') }}"><i class="fa fa-home"></i>Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb section end -->

    <!-- Shopping cart section begin -->
    <div class="shopping-cart spad">
        <div class="container">
            <div class="row">
                @if (count($cart) > 0)
                    <div class="col-lg-12">
                        <div class="cart-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th class="p-name">Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>
                                            <form action="{{ route('cart.deleteAll') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn"><i class="ti-close"></i></button>
                                            </form>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $item)
                                        <tr data-rowId="{{ $item->id }}">
                                            <td class="cart-pic first-row text-center">
                                                <img style="margin: auto; height: 100px;"
                                                    src="front/img/products/{{ $item->images }}" alt="">
                                            </td>
                                            <td class="cart-title first-row">
                                                {{ $item->name }}
                                            </td>
                                            <td class="p-price first-row">
                                                ${{ $item->price }}
                                            </td>
                                            <form action="{{ route('cart.update', $item->id) }}" method="post">
                                                @csrf
                                                <td class="qua-col first-row">
                                                    <div class="quantity">
                                                        <div class="pro-qty">
                                                            <input name="qty" type="text" value="{{ $item->qty }}"
                                                                data-rowid="{{ $item->id }}">
                                                        </div>
                                                    </div>
                                                    <button class="primary-btn btn up-cart mt-2">Update</button>
                                                </td>
                                            </form>
                                            <td class="total-price first-row">
                                                ${{ number_format($item->total) }}
                                            </td>
                                            <td class="close-td first-row">
                                                <form action="{{ route('cart.delete', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn"><i class="ti-close"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="cart-buttons">
                                    <a href="#" class="primary-btn continue-shop">Continue Shopping</a>
                                    <a href="#" class="primary-btn up-cart">Update cart</a>
                                </div>
                                <div class="discount-coupon">
                                    <h6>discount-coupon</h6>
                                    <form action="#" class="coupon-form">
                                        <input type="text" placeholder="Enter your codes">
                                        <button type="submit" class="site-btn coupon-btn">Apply</button>
                                    </form>
                                </div>

                            </div>
                            <div class="col-lg-4 offset-lg-4">
                                <div class="proceed-checkout">
                                    <ul>
                                        <li class="subtotal">subtotal <span>${{ number_format($subTotal) }}</span></li>
                                        <li class="cart-total">total <span>${{ number_format($subTotal) }}</span></li>
                                    </ul>
                                    <a href="{{ route('checkout.index') }}" class="proceed-btn">PROCEED TO CHECK OUT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-12">
                        <img style="margin: auto;" src="front/img/empty-cart.webp" alt="">
                    </div>
                @endif
            </div>

        </div>
    </div>
    <!-- Shopping cart section end -->
@endsection
