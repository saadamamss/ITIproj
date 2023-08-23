@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Shop
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p> We found <strong class="text-brand">
                                        {{ $products->total() }}
                                    </strong> items
                                    for you!</p>
                            </div>
                            <div class="sort-by-product-area">
                                <div class="sort-by-cover mr-10">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps"></i>Show:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="active" href="#">50</a></li>
                                            <li><a href="#">100</a></li>
                                            <li><a href="#">150</a></li>
                                            <li><a href="#">200</a></li>
                                            <li><a href="#">All</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="active" href="#">Featured</a></li>
                                            <li><a href="#">Price: Low to High</a></li>
                                            <li><a href="#">Price: High to Low</a></li>
                                            <li><a href="#">Release Date</a></li>
                                            <li><a href="#">Avg. Rating</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row product-grid-3">
                            @forelse ($products as $product)
                                <div class="col-lg-4 col-md-4 col-6 col-sm-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('product.details', $product->slug) }}">
                                                    <img class="default-img"
                                                        src="{{ asset('assets/imgs/shop/') . '/' . $product->image }}"
                                                        alt="">
                                                    <img class="hover-img"
                                                        src="{{ asset('assets/imgs/shop/') . '/' . $product->image }}"
                                                        alt="">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn hover-up"
                                                    data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                    <i class="fi-rs-search"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                    href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                        class="fi-rs-shuffle"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Hot</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="/shop">{{ $product->category->name }}</a>
                                            </div>
                                            <h2><a
                                                    href="{{ route('product.details', $product->slug) }}">{{ substr($product->name, 0, 20) }}...</a>
                                            </h2>
                                            <div>
                                                @for ($i = 0; $i < $product->rating; $i++)
                                                    <i class="rating-result"></i>
                                                @endfor

                                                @for ($i = 0; $i < 5 - $product->rating; $i++)
                                                    <i class="rating-result dark"></i>
                                                @endfor


                                                <span>
                                                    <span>{{ ($product->rating / 5) * 100 }}%</span>
                                                </span>
                                            </div>
                                            <div class="product-price">
                                                @if (is_null($product->sale_price))
                                                    <span>{{ $product->price }}</span>
                                                @else
                                                    <span>{{ $product->sale_price }}</span>
                                                    <span class="old-price">${{ $product->price }}</span>
                                                @endif
                                            </div>
                                            <div class="product-action-1 show">
                                                <a aria-label="Add To Cart" class="action-btn hover-up"
                                                    onclick="addToCart('{{ $product->id }}','{{ $product->name }}' , '{{ $product->price }}' ,1)"><i
                                                        class="fi-rs-shopping-bag-add"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h2 align="center" class="py-5">Shop Empty</h2>
                            @endforelse

                        </div>
                        <!--pagination-->
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">

                            {{ $products->links() }}

                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="row">
                            <div class="col-lg-12 col-mg-6"></div>
                            <div class="col-lg-12 col-mg-6"></div>
                        </div>
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
                            <ul class="categories">
                                @foreach ($catgs as $cat)
                                    <li><a href="{{ route('category.shop', $cat->slug) }}">{{ $cat->name }}</a></li>
                                @endforeach

                            </ul>
                        </div>
                        <!-- Fillter By Price -->
                        <div class="sidebar-widget price_range range mb-30">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Fill by price</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>


                            <form action="" method="get" enctype="multipart/form-data">
                                @isset($_GET['q'])
                                    <input type="hidden" name="q" value="{{ $_GET['q'] }}">
                                @endisset
                                <div class="price-filter">
                                    <div class="price-filter-inner">
                                        <div id="slider-range"></div>
                                        <div class="price_slider_amount">
                                            <div class="label-input">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <input type="text" id="minprice" name="minprice"
                                                            value="@if (isset($_GET['minprice'])) {{ $_GET['minprice'] }}@else{{ __('0') }} @endif">
                                                    </div>
                                                    <div class="col-6">
                                                        <input style="text-align: right" type="text" id="maxprice"
                                                            name="maxprice"
                                                            value="@if (isset($_GET['maxprice'])) {{ $_GET['maxprice'] }}@else{{ __('1000') }} @endif">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="list-group">
                                    <div class="list-group-item mb-10 mt-10">

                                        <div class="form-group">
                                            <label for="color" class="fw-900">Color</label>
                                            <select name="color" id="color" class="form-control">
                                                <option value="">------------</option>
                                                <option @if (isset($_GET['color']) && $_GET['color'] === 'red') selected @endif value="red">
                                                    Red</option>
                                                <option @if (isset($_GET['color']) && $_GET['color'] === 'blue') selected @endif value="blue">
                                                    Blue</option>
                                                <option @if (isset($_GET['color']) && $_GET['color'] === 'green') selected @endif value="green">
                                                    Green</option>
                                                <option @if (isset($_GET['color']) && $_GET['color'] === 'black') selected @endif value="black">
                                                    Black</option>
                                                <option @if (isset($_GET['color']) && $_GET['color'] === 'white') selected @endif value="white">
                                                    White</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="size" class="fw-900">Size</label>
                                            <select name="size" id="size" class="form-control">
                                                <option value="">------------</option>
                                                <option @if (isset($_GET['size']) && $_GET['size'] === 's') selected @endif value="s">
                                                    Small</option>
                                                <option @if (isset($_GET['size']) && $_GET['size'] === 'm') selected @endif value="m">
                                                    Meduim</option>
                                                <option @if (isset($_GET['size']) && $_GET['size'] === 'l') selected @endif value="l">
                                                    Large</option>
                                                <option @if (isset($_GET['size']) && $_GET['size'] === 'xl') selected @endif value="xl">
                                                    XLarge</option>
                                                <option @if (isset($_GET['size']) && $_GET['size'] === 'xll') selected @endif value="xxl">
                                                    XXLarge</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i>
                                    Fillter</a>
                            </form>



                        </div>
                        <!-- Product sidebar Widget -->

                        <div class="banner-img wow fadeIn mb-45 animated d-lg-block d-none">
                            <img src="{{ asset('assets/imgs/banner/banner-11.jpg') }}" alt="">
                            <div class="banner-text">
                                <span>Women Zone</span>
                                <h4>Save 17% on <br>Office Dress</h4>
                                <a href="/shop">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
