<header class="header-area header-style-1 header-height-2">
    <div class="header-top header-top-ptb-1 d-none d-lg-block">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>
                            <li>
                                <a class="language-dropdown-active" href="#"> <i class="fi-rs-world"></i> English <i
                                        class="fi-rs-angle-small-down"></i></a>
                                <ul class="language-dropdown">
                                    <li><a href="#"><img src="{{ asset('assets/imgs/theme/flag-fr.png') }}"
                                                alt="">Français</a></li>
                                    <li><a href="#"><img src="{{ asset('assets/imgs/theme/flag-dt.png') }}"
                                                alt="">Deutsch</a></li>
                                    <li><a href="#"><img src="{{ asset('assets/imgs/theme/flag-ru.png') }}"
                                                alt="">Pусский</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li>Get great devices up to 50% off <a href="{{ Route('shop') }}">View details</a></li>
                                <li>Supper Value Deals - Save more with coupons</li>
                                <li>Trendy 25silver jewelry, save up 35% off today <a href="{{ Route('shop') }}">Shop
                                        now</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            @if (Route::has('login'))
                                @auth

                                    <li><i class="fi-rs-user"></i>{{ Auth::user()->name }} &ThickSpace; /
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                                        </form>
                                    </li>
                                @else
                                    <li><i class="fi-rs-key"></i><a href="{{ route('login') }}">Log In </a> / <a
                                            href="{{ route('register') }}">Sign Up</a></li>
                                @endauth
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="/"><img src="{{ asset('assets/imgs/logo/') . '/' . $mainsettings->sitelogo }}"
                            alt="logo"></a>
                </div>
                <div class="header-right">
                    <div class="search-style-1">
                        <form action="{{ route('product.search') }}" method="get">

                            <input type="search" name="q" placeholder="Search for items...">
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">

                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('cart') }}">
                                    <img alt="Surfside Media"
                                        src="{{ asset('assets/imgs/theme/icons/icon-cart.svg') }}">
                                    <span class="pro-count blue" id="cartitemscount">
                                        {{ Cart::instance('cart')->content()->count() }}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="/"><img src="{{ asset('assets/imgs/logo/') . '/' . $mainsettings->sitelogo }}"
                            alt="logo"></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categori-button-active" href="#">
                            <span class="fi-rs-apps"></span> Browse Categories
                        </a>
                        <div class="categori-dropdown-wrap categori-dropdown-active-large">
                            <ul>

                                @forelse ($catgs as $cat)
                                    @if (count($cat->subcategory) > 0)
                                        <li class="has-children">
                                            <a href="{{ route('category.shop', $cat->slug) }}"><i
                                                    class="surfsidemedia-font-dress"></i>{{ $cat->name }}</a>
                                            <div class="dropdown-menu">
                                                <ul class="mega-menu d-lg-flex">
                                                    <li class="mega-menu-col col-lg-7">
                                                        <ul class="d-lg-flex">
                                                            <li class="mega-menu-col col-lg-6">
                                                                <ul>
                                                                    <li><span
                                                                            class="submenu-title">{{ $cat->name }}</span>
                                                                    </li>
                                                                    @foreach ($cat->subcategory as $item)
                                                                        <li><a class="dropdown-item nav-link nav_item"
                                                                                href="">{{ $item->name }}</a>
                                                                        </li>
                                                                    @endforeach

                                                                </ul>
                                                            </li>

                                                        </ul>
                                                    </li>
                                                    <li class="mega-menu-col col-lg-5">
                                                        <div class="header-banner2">
                                                            <img src="{{ asset('assets/imgs/banner/menu-banner-2.jpg') }}"
                                                                alt="menu_banner1">
                                                            <div class="banne_info">
                                                                <h6>10% Off</h6>
                                                                <h4>New Arrival</h4>
                                                                <a href="#">Shop now</a>
                                                            </div>
                                                        </div>
                                                        <div class="header-banner2">
                                                            <img src="{{ asset('assets/imgs/banner/menu-banner-3.jpg') }}"
                                                                alt="menu_banner2">
                                                            <div class="banne_info">
                                                                <h6>15% Off</h6>
                                                                <h4>Hot Deals</h4>
                                                                <a href="#">Shop now</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    @else
                                        <li><a href="category/{{ $cat->slug }}"><i
                                                    class="surfsidemedia-font-desktop"></i>{{ $cat->name }}</a>
                                        </li>
                                    @endif
                                @empty
                                @endforelse

                            </ul>
                            <div class="more_categories">Show more...</div>
                        </div>
                    </div>
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                        <nav>
                            <ul>
                                <li></li>
                                <li><a class="@if ($_SERVER['REQUEST_URI'] == '/') active @endif"
                                        href="{{ route('home') }}">Home </a></li>
                                <li><a class="@if ($_SERVER['REQUEST_URI'] == '/shop') active @endif"
                                        href="{{ Route('shop') }}">Shop</a></li>


                                <li><a class="@if ($_SERVER['REQUEST_URI'] == '/cart') active @endif"
                                        href="{{ route('cart') }}">Cart </a></li>
                                <li><a class="@if ($_SERVER['REQUEST_URI'] == '/about') active @endif"
                                        href="{{ route('about') }}">About</a></li>
                                <li><a class="@if ($_SERVER['REQUEST_URI'] == '/contact') active @endif"
                                        href="{{ route('contact') }}">Contact</a></li>

                                @auth

                                    <li><a href="#">My Account<i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">

                                            @if (Auth::user()->UType === 'ADM')
                                                <li><a href="admin/dashboard">Dashboard</a></li>
                                                <li><a href="admin/products">Products</a></li>
                                                <li><a href="admin/categories">Categories</a></li>
                                                <li><a href="admin/coupon">Coupons</a></li>
                                                <li><a href="admin/orders">Orders</a></li>
                                                <li><a href="admin/customer">Customers</a></li>
                                            @else
                                                <li><a href="/orders">Orders</a></li>
                                            @endif


                                            <li>
                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                    <a href="{{ route('logout') }}"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                                                </form>
                                            </li>
                                        </ul>

                                    </li>
                                @endauth

                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="hotline d-none d-lg-block">
                    <p><i class="fi-rs-smartphone"></i><span>Toll Free</span>{{ $mainsettings->phone }}</p>
                </div>
                <p class="mobile-promotion">Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to 40%</p>

                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">

                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="{{ route('cart') }}">
                                <img alt="Surfside Media" src="{{ asset('assets/imgs/theme/icons/icon-cart.svg') }}">
                                <span class="pro-count white">2</span>
                            </a>

                        </div>
                        <div class="header-action-icon-2 d-block d-lg-none">
                            <div class="burger-icon burger-icon-white">
                                <span class="burger-icon-top"></span>
                                <span class="burger-icon-mid"></span>
                                <span class="burger-icon-bottom"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="/"><img src="{{ asset('assets/imgs/logo/') . '/' . $mainsettings->sitelogo }}"
                        alt="logo"></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="#">
                    <input type="text" placeholder="Search for items…">
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <div class="main-categori-wrap mobile-header-border">
                    <a class="categori-button-active-2" href="#">
                        <span class="fi-rs-apps"></span> Browse Categories
                    </a>
                    <div class="categori-dropdown-wrap categori-dropdown-active-small">
                        <ul>
                            <li><a href="{{ Route('shop') }}"><i class="surfsidemedia-font-dress"></i>Women's
                                    Clothing</a></li>
                            <li><a href="{{ Route('shop') }}"><i class="surfsidemedia-font-tshirt"></i>Men's
                                    Clothing</a></li>
                            <li> <a href="{{ Route('shop') }}"><i class="surfsidemedia-font-smartphone"></i>
                                    Cellphones</a></li>
                            <li><a href="{{ Route('shop') }}"><i class="surfsidemedia-font-desktop"></i>Computer &
                                    Office</a></li>
                            <li><a href="{{ Route('shop') }}"><i class="surfsidemedia-font-cpu"></i>Consumer
                                    Electronics</a></li>
                            <li><a href="{{ Route('shop') }}"><i class="surfsidemedia-font-home"></i>Home &
                                    Garden</a></li>
                            <li><a href="{{ Route('shop') }}"><i class="surfsidemedia-font-high-heels"></i>Shoes</a>
                            </li>
                            <li><a href="{{ Route('shop') }}"><i class="surfsidemedia-font-teddy-bear"></i>Mother &
                                    Kids</a></li>
                            <li><a href="{{ Route('shop') }}"><i class="surfsidemedia-font-kite"></i>Outdoor fun</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                href="index.html">Home</a></li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                href="{{ Route('shop') }}">shop</a></li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Our
                                Collections</a>
                            <ul class="dropdown">
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                        href="#">Women's Fashion</a>
                                    <ul class="dropdown">
                                        <li><a href="product-details.html">Dresses</a></li>
                                        <li><a href="product-details.html">Blouses & Shirts</a></li>
                                        <li><a href="product-details.html">Hoodies & Sweatshirts</a></li>
                                        <li><a href="product-details.html">Women's Sets</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                        href="#">Men's Fashion</a>
                                    <ul class="dropdown">
                                        <li><a href="product-details.html">Jackets</a></li>
                                        <li><a href="product-details.html">Casual Faux Leather</a></li>
                                        <li><a href="product-details.html">Genuine Leather</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                        href="#">Technology</a>
                                    <ul class="dropdown">
                                        <li><a href="product-details.html">Gaming Laptops</a></li>
                                        <li><a href="product-details.html">Ultraslim Laptops</a></li>
                                        <li><a href="product-details.html">Tablets</a></li>
                                        <li><a href="product-details.html">Laptop Accessories</a></li>
                                        <li><a href="product-details.html">Tablet Accessories</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                href="blog.html">Blog</a></li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                href="#">Language</a>
                            <ul class="dropdown">
                                <li><a href="#">English</a></li>
                                <li><a href="#">French</a></li>
                                <li><a href="#">German</a></li>
                                <li><a href="#">Spanish</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap mobile-header-border">
                <div class="single-mobile-header-info mt-30">
                    <a href="{{ route('contact') }}"> Our location </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="{{ route('login') }}">Log In </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="{{ route('register') }}">Sign Up</a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="#">(+1) 0000-000-000 </a>
                </div>
            </div>
            <div class="mobile-social-icon">
                <h5 class="mb-15 text-grey-4">Follow Us</h5>
                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-facebook.svg') }}"
                        alt=""></a>
                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-twitter.svg') }}"
                        alt=""></a>
                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-instagram.svg') }}"
                        alt=""></a>
                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-pinterest.svg') }}"
                        alt=""></a>
                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-youtube.svg') }}"
                        alt=""></a>
            </div>
        </div>
    </div>
</div>
