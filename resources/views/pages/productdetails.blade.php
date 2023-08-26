@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> <a href="/shop" rel="nofollow">Shop</a>
                    <span></span> {{ $product->name }}
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50">
                                <div class="col-md-6 col-sm-12 col-xs-12 px-5">
                                    <div class="detail-gallery">
                                        <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                        <!-- MAIN SLIDES -->
                                        <div class="product-image-slider">
                                            @for ($i = 0; $i < 5; $i++)
                                                <figure class="border-radius-10">
                                                    <img src="{{ asset('assets/imgs/shop') . '/' . $product->image }}"
                                                        alt="product image">
                                                </figure>
                                            @endfor
                                        </div>
                                        <!-- THUMBNAILS -->
                                        <div class="slider-nav-thumbnails pl-15 pr-15">

                                            @for ($i = 0; $i < 5; $i++)
                                                <div><img src="{{ asset('assets/imgs/shop') . '/' . $product->image }}"
                                                        alt="product image"></div>
                                            @endfor
                                        </div>
                                    </div>
                                    <!-- End Gallery -->

                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info">
                                        <h2 class="title-detail">{{ $product->name }}</h2>
                                        <div class="product-detail-rating">

                                            <div>
                                                @php
                                                    $totalrate = count($product->reviews) * 5;
                                                    $acualrate = 0;
                                                    if ($totalrate > 0) {
                                                        foreach ($product->reviews as $review) {
                                                            $acualrate += $review->rate;
                                                        }
                                                        $percent = $acualrate / $totalrate;
                                                    } else {
                                                        $percent = 0;
                                                    }
                                                    $starrate = intval($percent * 5);
                                                @endphp

                                                @for ($i = 0; $i < $starrate; $i++)
                                                    <i class="rating-result"></i>
                                                @endfor

                                                @for ($i = 0; $i < 5 - $starrate; $i++)
                                                    <i class="rating-result dark"></i>
                                                @endfor


                                                <span>
                                                    <span>{{ intval($percent * 100) }}%</span>
                                                </span>

                                            </div>

                                        </div>
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">

                                                @if (is_null($product->sale_price))
                                                    <ins><span class="text-brand">${{ $product->price }}</span></ins>
                                                @else
                                                    <ins><span class="text-brand">${{ $product->sale_price }}</span></ins>
                                                    <ins><span
                                                            class="old-price font-md ml-15">${{ $product->price }}</span></ins>
                                                    <span
                                                        class="save-price  font-md color3 ml-15">{{ intval((1 - $product->sale_price / $product->price) * 100) }}%
                                                        Off</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="bt-1 border-color-1 mt-15 mb-15"></div>

                                        <div class="product_sort_info font-xs mb-30">
                                            <ul>
                                                <li class="mb-10"><i class="fi-rs-crown mr-5"></i> 1 Year AL Jazeera Brand
                                                    Warranty</li>
                                                <li class="mb-10"><i class="fi-rs-refresh mr-5"></i> 30 Day Return Policy
                                                </li>
                                                <li><i class="fi-rs-credit-card mr-5"></i> Cash on Delivery available</li>
                                            </ul>
                                        </div>
                                        @if ($product->color)
                                            <div class="attr-detail attr-color mb-15">
                                                <strong class="mr-10">Color</strong>
                                                <ul class="list-filter color-filter">
                                                    <li @if ($product->color === 'red') class="active" @endif><a
                                                            href="#" data-color="Red"><span
                                                                class="product-color-red"></span></a></li>
                                                    <li @if ($product->color === 'yellow') class="active" @endif><a
                                                            href="#" data-color="Yellow"><span
                                                                class="product-color-yellow"></span></a></li>
                                                    <li @if ($product->color === 'white') class="active" @endif><a
                                                            href="#" data-color="White"><span
                                                                class="product-color-white"></span></a></li>
                                                    <li @if ($product->color === 'orange') class="active" @endif><a
                                                            href="#" data-color="Orange"><span
                                                                class="product-color-orange"></span></a></li>
                                                    <li @if ($product->color === 'cyan') class="active" @endif><a
                                                            href="#" data-color="Cyan"><span
                                                                class="product-color-cyan"></span></a></li>
                                                    <li @if ($product->color === 'green') class="active" @endif><a
                                                            href="#" data-color="Green"><span
                                                                class="product-color-green"></span></a></li>
                                                    <li @if ($product->color === 'purple') class="active" @endif><a
                                                            href="#" data-color="Purple"><span
                                                                class="product-color-purple"></span></a></li>
                                                </ul>
                                            </div>
                                        @endif
                                        @if ($product->size)
                                            <div class="attr-detail attr-size">
                                                <strong class="mr-10">Size</strong>
                                                <ul class="list-filter size-filter font-small">
                                                    <li @if ($product->size === 's') class="active" @endif><a
                                                            href="#">S</a></li>
                                                    <li @if ($product->size === 'm') class="active" @endif><a
                                                            href="#">M</a></li>
                                                    <li @if ($product->size === 'l') class="active" @endif><a
                                                            href="#">L</a></li>
                                                    <li @if ($product->size === 'xl') class="active" @endif><a
                                                            href="#">XL</a></li>
                                                    <li @if ($product->size === 'xxl') class="active" @endif><a
                                                            href="#">XXL</a></li>
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                        <div class="detail-extralink">

                                            <div class="product-extra-link2">
                                                <button type="submit" class="button button-add-to-cart"
                                                    onclick="addToCart('{{ $product->id }}','{{ $product->name }}' , '{{ $product->price }}' ,1)">Add
                                                    to
                                                    cart</button>
                                                <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                    href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                        class="fi-rs-shuffle"></i></a>
                                            </div>
                                        </div>
                                        <ul class="product-meta font-xs color-grey mt-50">
                                            <li>Availability:<span
                                                    class="in-stock text-success ml-5">{{ $product->quantity }} Items In
                                                    Stock</span></li>
                                        </ul>
                                    </div>
                                    <!-- Detail Info -->
                                </div>
                            </div>
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                            href="#Description">Description</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab"
                                            href="#Reviews">Reviews
                                            ({{ count($product->reviews) }})</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        
                                        {{ $product->desc }}

                                    </div>

                                    <div class="tab-pane fade" id="Reviews">
                                        <!--Comments-->
                                        <div class="comments-area">
                                            <div class="row">
                                                <div class="col-lg-8" id="reviewscont">
                                                    <h4 class="mb-30">Customer questions & answers</h4>
                                                    @forelse ($product->reviews as $review)
                                                        <div class="comment-list">
                                                            <div class="single-comment justify-content-between d-flex">
                                                                <div class="user justify-content-between d-flex">
                                                                    <div class="thumb text-center">
                                                                        <img src="{{ asset('assets/imgs/page/avatar-6.jpg') }}"
                                                                            alt="">

                                                                        <h6><a
                                                                                href="#">{{ $review->user->name }}</a>
                                                                        </h6>
                                                                    </div>
                                                                    <div class="desc">

                                                                        <div class="product-detail-rating d-inline-block">

                                                                            <div class="">
                                                                                @for ($i = 0; $i < $review->rate; $i++)
                                                                                    <i class="rating-result"></i>
                                                                                @endfor

                                                                                @for ($i = 0; $i < 5 - $review->rate; $i++)
                                                                                    <i class="rating-result dark"></i>
                                                                                @endfor

                                                                            </div>

                                                                        </div>

                                                                        <p>
                                                                            {{ $review->review }}
                                                                        </p>
                                                                        <div class="d-flex justify-content-between">
                                                                            <div class="d-flex align-items-center">
                                                                                <p class="font-xs mr-30">
                                                                                    {{ Carbon\Carbon::parse($review['created_at'])->format('M d Y') }}
                                                                                </p>
                                                                                {{--
                                                                                <a href="#"
                                                                                    class="text-brand btn-reply">Reply <i
                                                                                        class="fi-rs-arrow-right"></i> </a>
                                                                                    --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!--single-comment -->

                                                        </div>

                                                    @empty
                                                        <h3 align="center">No Reviews</h3>
                                                    @endforelse
                                                </div>
                                                <div class="col-lg-4">
                                                    <h4 class="mb-30">Customer reviews</h4>
                                                    <div class="d-flex mb-30">
                                                        <div class="product-rate d-inline-block mr-15">
                                                            <div class="product-rating" style="width:90%">
                                                            </div>
                                                        </div>
                                                        <h6>4.8 out of 5</h6>
                                                    </div>
                                                    <div class="progress">
                                                        <span>5 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 50%;"
                                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>4 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>3 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 45%;"
                                                            aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>2 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 65%;"
                                                            aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%
                                                        </div>
                                                    </div>
                                                    <div class="progress mb-30">
                                                        <span>1 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 85%;"
                                                            aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%
                                                        </div>
                                                    </div>
                                                    <a href="#" class="font-xs text-muted">How are ratings
                                                        calculated?</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--comment form-->
                                        @auth
                                            <form method="post" id="addreviewForm">
                                                <div class="comment-form">
                                                    <h4 class="mb-15">Add a review</h4>
                                                    <div class="d-inline-flex mb-30 addrate">
                                                        <input type="radio" name="rate" class="rate" data-value="1"
                                                            value="1">
                                                        <input type="radio" name="rate" class="rate" data-value="2"
                                                            value="2">
                                                        <input type="radio" name="rate" class="rate" data-value="3"
                                                            value="3">
                                                        <input type="radio" name="rate" class="rate" data-value="4"
                                                            value="4">
                                                        <input type="radio" name="rate" class="rate" data-value="5"
                                                            value="5">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-8 col-md-12">
                                                            <form class="form-contact comment_form" action="#"
                                                                id="commentForm">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                                                                placeholder="Write Comment" required></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit"
                                                                        class="button button-contactForm">Submit
                                                                        Review</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @endauth


                                    </div>
                                </div>
                            </div>
                            <div class="row mt-60">
                                <div class="col-12">
                                    <h3 class="section-title style-1 mb-30">Related products</h3>
                                </div>
                                <div class="col-12">
                                    <div class="row related-products">
                                        @forelse ($relatedprod as $item)
                                            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                                <div class="product-cart-wrap mb-30">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom">
                                                            <a href="{{ route('product.details', $item->slug) }}">
                                                                <img class="default-img"
                                                                    src="{{ asset('assets/imgs/shop') . '/' . $item->image }}"
                                                                    alt="">
                                                                <img class="hover-img"
                                                                    src="{{ asset('assets/imgs/shop') . '/' . $item->image }}"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                        <div class="product-action-1">
                                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                                    class="fi-rs-eye"></i></a>
                                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                                            <a aria-label="Compare" class="action-btn hover-up"
                                                                href="compare.php"><i class="fi-rs-shuffle"></i></a>
                                                        </div>
                                                        <div
                                                            class="product-badges product-badges-position product-badges-mrg">
                                                            <span class="hot">Hot</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-content-wrap">
                                                        <div class="product-category">
                                                            <a
                                                                href="{{ route('category.shop', $item->category->slug) }}">{{ $item->category->name }}</a>
                                                        </div>
                                                        <h2><a
                                                                href="{{ route('product.details', $item->slug) }}">{{ substr($item->name, 0, 20) }}...</a>
                                                        </h2>
                                                        <div>
                                                            @for ($i = 0; $i < $item->rating; $i++)
                                                                <i class="rating-result"></i>
                                                            @endfor

                                                            @for ($i = 0; $i < 5 - $item->rating; $i++)
                                                                <i class="rating-result dark"></i>
                                                            @endfor


                                                            <span>
                                                                <span>{{ ($item->rating / 5) * 100 }}%</span>
                                                            </span>
                                                        </div>
                                                        <div class="product-price">
                                                            @if (is_null($item->sale_price))
                                                                <span>{{ $item->price }}</span>
                                                            @else
                                                                <span>{{ $item->sale_price }}</span>
                                                                <span class="old-price">${{ $item->price }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="product-action-1 show">
                                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                                onclick="addToCart('{{ $item->id }}','{{ $item->name }}' , '{{ $item->price }}' ,1)"><i
                                                                    class="fi-rs-shopping-bag-add"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
@section('scripts')
    @auth
        <script>
            $(document).on('submit', '#addreviewForm', function(e) {
                e.preventDefault();
                const _this = $(this)[0];

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });
                $.ajax({
                    url: "{{ route('addreview', $product->id) }}",
                    type: "post",
                    data: $(this).serialize(),
                    datatype: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response === true) {

                            $('#reviewscont').append(appendreview(parseInt(_this.elements.rate.value), _this
                                .elements
                                .comment.value));

                            $('.rate').removeClass('active');
                            _this.reset();

                        }
                    },
                    error: function(res) {
                        var errors = res.responseJSON.errors;
                        console.log(errors);

                    }
                });
            });



            function appendreview(rate, comment) {

                var html = `<div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb text-center">
                                        <img src="{{ asset('assets/imgs/page/avatar-6.jpg') }}" alt="">
                                        <h6><a href="#">{{ Auth::user()->name }}</a>
                                        </h6>
                                    </div>
                                    <div class="desc">
                                        <div class="product-detail-rating d-inline-block">
                                            <div class="">`;

                for (let i = 0; i < rate; i++) {
                    html += `<i class="rating-result"></i>`;
                }


                for (let i = 0; i < (5 - rate); i++) {
                    html += `<i class="rating-result dark"></i>`;
                }

                html += `</div>
                         </div>
                            <p>${comment}</p>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <p class="font-xs mr-30">
                                        {{ Carbon\Carbon::now()->format('M d Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>`;


                return html;
            }
        </script>
    @endauth
@endsection
