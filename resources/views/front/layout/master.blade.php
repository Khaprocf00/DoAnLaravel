<!DOCTYPE html>
<html lang="zxx">

<head>

    <base href="{{ asset('/') }}">
    <meta charset="UTF-8" />
    <meta name="description" content="codelean Template" />
    <meta name="keywords" content="codelean, unica, creative, html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title') | FashoinMK</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap"
        rel="stylesheet" />

    <!-- Css Styles -->
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <link rel="stylesheet" href="front/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="front/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="front/css/themify-icons.css" type="text/css" />
    <link rel="stylesheet" href="front/css/elegant-icons.css" type="text/css" />
    <link rel="stylesheet" href="front/css/owl.carousel.min.css" type="text/css" />
    <link rel="stylesheet" href="front/css/nice-select.css" type="text/css" />
    <link rel="stylesheet" href="front/css/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" href="front/css/slicknav.min.css" type="text/css" />
    <link rel="stylesheet" href="front/css/style.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <!-- Start coding here -->
    <!-- header section begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class="fa fa-envelope"></i>
                        nmk16032002@gmail.com
                    </div>
                    <div class="phone-service">
                        <i class="fa fa-phone"></i>
                        0799746311
                    </div>
                </div>
                <div class="ht-right">
                    @if (Auth::check())
                        <a href="{{ route('logout.index') }}" class="login-panel"><i
                                class="fa fa-user"></i>{{ Auth::user()->name }} - Logout</a>
                    @else
                        <a href="{{ route('login.index') }}" class="login-panel"><i class="fa fa-user"></i>Login</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="{{ route('home.index') }}"> <img src="front/img/logo.jpg" />
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <form action="shop">
                            <div class="advanced-search">
                                <button type="button" class="category-btn">All Categories</button>
                                <div class="input-group">
                                    <input type="text" name="search" placeholder="What do you need?"
                                        value="{{ request('search') }}">
                                    <button type="submit"><i class="ti-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 col-md-3 text-right">
                        <ul class="nav-right">

                            <li class="cart-icon">
                                <a href="{{ route('cart.index') }}">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <span>{{ count($cart) }}</span>
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <style>
                                            .select-items {
                                                height: 300px;
                                                overflow-y: scroll;
                                                padding-right: 10px;
                                            }

                                            .cart-hover .select-items::after {
                                                content: "";
                                                position: absolute;
                                                top: -30px;
                                                right: 0;
                                                width: 100%;
                                                height: 30px;
                                                background: transparent;
                                            }

                                            .select-items::-webkit-scrollbar {
                                                width: 5px;
                                            }

                                            /* Track */
                                            .select-items::-webkit-scrollbar-track {
                                                background: #f1f1f1;
                                                border-radius: 20px;

                                            }

                                            /* Handle */
                                            .select-items::-webkit-scrollbar-thumb {
                                                background: #e7ab3c;
                                                border-radius: 20px;

                                            }

                                            /* Handle on hover */
                                            .select-items::-webkit-scrollbar-thumb:hover {
                                                background: #555;
                                                border-radius: 20px;
                                            }
                                        </style>
                                        @if (count($cart) > 0)
                                            <table>
                                                <tbody>
                                                    @foreach ($cart as $item)
                                                        <tr data-rowId="{{ $item->id }}">
                                                            <td class="si-pic">
                                                                <img style="height: 70px"
                                                                    src="front/img/products/{{ $item->images }}"
                                                                    alt="">
                                                            </td>
                                                            <td class="si-text">
                                                                <div class="product-selected">
                                                                    <p>${{ $item->price }} x {{ $item->qty }}</p>
                                                                    <h6>{{ $item->name }}</h6>
                                                                </div>
                                                            </td>
                                                            <td class="si-close">
                                                                <form action="{{ route('cart.delete', $item->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn"><i
                                                                            class="ti-close"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <div class="col-lg-12">
                                                <img style="margin: 20px auto 0; " src="front/img/empty-cart.webp"
                                                    alt="">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="select-total">
                                        <span>total:</span>
                                        <h5>${{ number_format($subTotal) }}</h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="{{ route('cart.index') }}" class="primary-btn view-card">VIEW
                                            CART</a>
                                        <a href="{{ route('checkout.index') }}"
                                            class="primary-btn checkout-btn">CHECK OUT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="cart-price">
                                ${{ number_format($subTotal) }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>All deparments</span>
                        <ul class="depart-hover">
                            {{-- <li class="active"><a href="">Women's clothing</a></li> --}}
                            <li><a href="shop/category/Women">Women's clothing</a></li>
                            <li><a href="shop/category/Men">Men's clothing</a></li>
                            <li><a href="shop/category/Kids">Kid's clothing</a></li>
                            <li><a href="shop?brand%5B1%5D=on">Brand Calvin Klein</a></li>
                            <li><a href="shop?brand%5B3%5D=on">Polo</a></li>
                            <li><a href="shop?brand%5B2%5D=on">Brand Diesel</a></li>
                            <li><a href="shop?brand%5B4%5D=on">Brand Tommy Hilfiger</a></li>
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="{{ request()->segment(1) == '' ? 'active' : '' }}"><a href="./">Home</a>
                        </li>
                        <li class="{{ request()->segment(1) == 'shop' ? 'active' : '' }}"><a href="./shop">Shop</a>
                        </li>
                        {{-- <li><a href="blog.html">Blog</a></li> --}}
                        {{-- <li><a href="contact.html">Contact</a></li> --}}
                        <li><a href="">Pages</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('cart.index') }}">Cart shopping</a></li>
                                <li><a href="{{ route('checkout.index') }}">Check out</a></li>
                            </ul>
                        </li>
                    </ul>

                </nav>
            </div>
        </div>
    </header>
    <!-- header section end -->

    @yield('content')

    <!-- partner logo section begin -->
    <div class="partner-logo">
        <div class="container">
            <div class="logo-carousel owl-carousel">
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="front/img/logo-carousel/logo-1.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="front/img/logo-carousel/logo-2.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="front/img/logo-carousel/logo-3.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="front/img/logo-carousel/logo-4.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="front/img/logo-carousel/logo-5.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- partner logo section End -->

    <!-- footer section begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="">
                                <h3 style="color: #f1f1f1; font-weight: 900">Fashion MK</h3>
                            </a>
                        </div>
                        <ul>
                            <li>75 Đường 265 Hiệp Phú Quận 9</li>
                            <li>Phone : +84 0799746311</li>
                            <li>Email : nmk16032002@gmail.com</li>
                        </ul>
                        <div class="footer-social">
                            <a href=""><i class="fa fa-facebook"></i></a>
                            <a href=""><i class="fa fa-instagram"></i></a>
                            <a href=""><i class="fa fa-twitter"></i></a>
                            <a href=""><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <div class="footer-widget">
                        <h5>
                            Information
                        </h5>
                        <ul>
                            <li><a href="">About Us</a></li>
                            <li><a href="">Checkout</a></li>
                            <li><a href="">Contact</a></li>
                            <li><a href="">Serivius</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h5>
                            My Account
                        </h5>
                        <ul>
                            <li><a href="">My Account</a></li>
                            <li><a href="">Contact</a></li>
                            <li><a href="{{ route('cart.index') }}">Shopping Cart</a></li>
                            <li><a href="{{ route('shop.index') }}">Shop</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="newslatter-item">
                        <h5>Join Our Newsletter Now</h5>
                        <p>Get E-mail updates about our latest shop and special offers</p>
                        <form action="" class="subscribe-form">
                            <input type="text" placeholder="Enter Your Email">
                            <button type="button">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </footer>

    <!-- footer section end -->

    <!-- Js Plugins -->
    <script src="front/js/jquery-3.3.1.min.js"></script>
    <script src="front/js/bootstrap.min.js"></script>
    <script src="front/js/jquery-ui.min.js"></script>
    <script src="front/js/jquery.countdown.min.js"></script>
    <script src="front/js/jquery.nice-select.min.js"></script>
    <script src="front/js/jquery.zoom.min.js"></script>
    <script src="front/js/jquery.dd.min.js"></script>
    <script src="front/js/jquery.slicknav.js"></script>
    <script src="front/js/owl.carousel.min.js"></script>
    <script src="front/js/owlcarousel2_filter.min.js"></script>
    <script src="front/js/main.js"></script>
</body>

</html>
