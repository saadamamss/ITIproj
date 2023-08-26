@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Your Cart
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12" id="cartcontent">
                        @if (Cart::instance('cart')->content()->count() > 0)
                            <div class="content">

                                <div class="table-responsive">
                                    <table class="table shopping-summery text-center clean" id="carttable">
                                        <thead>
                                            <tr class="main-heading">
                                                <th scope="col">Image</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Subtotal</th>
                                                <th scope="col">Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (Cart::instance('cart')->content() as $item)
                                                <tr id="{{ $item->rowId }}">
                                                    <td class="image product-thumbnail"><img
                                                            src="{{ asset('assets/imgs/shop') . '/' . $item->model->image }}"
                                                            alt="#"></td>
                                                    <td class="product-des product-name">
                                                        <h5 class="product-name"><a
                                                                href="product-details.html">{{ $item->name }}</a></h5>
                                                        <p class="font-xs">
                                                            {{ substr($item->model->desc, 0, 80) }}
                                                        </p>
                                                    </td>
                                                    <td class="price" data-title="Price"><span>${{ $item->price }}</span>
                                                    </td>
                                                    <td class="text-center" data-title="Stock">
                                                        <div class="detail-qty m-auto">
                                                            <a class="qty-down"><i class="fi-rs-minus"></i></a>
                                                            <span class="qty-val border raduis px-4 py-2"
                                                                data-id="{{ $item->rowId }}">{{ $item->qty }}</span>
                                                            <a class="qty-up"><i class="fi-rs-plus"></i></a>
                                                        </div>
                                                    </td>
                                                    <td class="text-right" data-title="Cart">
                                                        <span class="subtotal">${{ $item->subtotal }}</span>
                                                    </td>
                                                    <td class="action" data-title="Remove"><a href="#"
                                                            class="text-muted"
                                                            onclick="deleteItem('{{ $item->rowId }}')"><i
                                                                class="fi-rs-trash"></i></a></td>
                                                </tr>
                                            @endforeach


                                            <tr>
                                                <td colspan="6" class="text-end">
                                                    <a href="#" class="text-muted" id="clearcart"> <i
                                                            class="fi-rs-cross-small"></i>
                                                        Clear Cart</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="cart-action text-end">
                                    <a class="btn" href="{{ route('shop') }}"><i
                                            class="fi-rs-shopping-bag mr-10"></i>Continue Shopping</a>

                                </div>
                                <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                                <div class="row mb-50">

                                    @if (!session('coupon'))
                                        <div class="col-lg-6 col-md-12">

                                            <div class="mb-30 mt-50">
                                                <div class="heading_s1 mb-3">
                                                    <h4>Apply Coupon</h4>
                                                </div>
                                                <div class="total-amount">
                                                    <div class="left">
                                                        <div class="coupon">
                                                            <form action="#" method="post" id="applycouponForm">

                                                                <div class="form-row row justify-content-center">
                                                                    <div class="form-group col-lg-6">
                                                                        <input class="font-medium" name="Coupon"
                                                                            placeholder="Enter Your Coupon">

                                                                        <span class="text-danger" id="couponerror"></span>
                                                                    </div>


                                                                    <div class="form-group col-lg-6">
                                                                        <button type="submit" class="btn  btn-sm"><i
                                                                                class="fi-rs-label mr-10"></i>Apply</button>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-lg-6 col-md-12">
                                        <div class="border p-md-4 p-30 border-radius cart-totals">
                                            <div class="heading_s1 mb-3">
                                                <h4>Cart Totals</h4>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="cart_total_label">Cart Subtotal</td>
                                                            <td class="cart_total_amount"><span
                                                                    class="font-lg fw-900 text-brand"
                                                                    id="cartsubtotal">${{ Cart::instance('cart')->subtotal() }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="cart_total_label">Shipping</td>
                                                            <td class="cart_total_amount"> <i class="ti-gift mr-5"></i>
                                                                Free Shipping</td>
                                                        </tr>

                                                        <tr>
                                                            <td class="cart_total_label">
                                                                @if (session('coupon'))
                                                                    Total Before Coupon
                                                                @else
                                                                    Total
                                                                @endif
                                                            </td>
                                                            <td class="cart_total_amount">
                                                                <strong>
                                                                    <span class="font-xl fw-900 text-brand" id="carttotal">
                                                                        ${{ Cart::instance('cart')->total() }}
                                                                    </span>
                                                                </strong>
                                                            </td>
                                                        </tr>

                                                        @if (session('coupon'))
                                                            <tr class="bg-light">
                                                                <td class="cart_total_label">Total After Coupon</td>
                                                                <td class="cart_total_amount">
                                                                    <strong>
                                                                        <span class="font-xl fw-900 text-brand"
                                                                            id="carttotal">
                                                                            @if (session('coupon')->type === 'fixed')
                                                                                ${{ number_format(preg_replace('/,/i', '', Cart::instance('cart')->total()) - session('coupon')->value, 2, '.', '') }}
                                                                            @else
                                                                                ${{ number_format(preg_replace('/,/i', '', Cart::instance('cart')->total()) * (session('coupon')->value / 100), 2, '.', '') }}
                                                                            @endif
                                                                        </span>
                                                                    </strong>
                                                                </td>
                                                            </tr>
                                                        @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                            <a href="{{ route('checkout') }}" class="btn "> <i
                                                    class="fi-rs-box-alt mr-10"></i>
                                                Proceed To CheckOut</a>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        @else
                            <div class="content border rounded py-5 text-center">
                                <h3 class="py-5">
                                    @if (session('thank-you'))
                                        {{ session('thank-you') }}
                                        @php
                                            session()->forget('thank-you');
                                        @endphp
                                    @else
                                        Cart Empty
                                    @endif
                                </h3>
                                <a href="/shop">continue shopping &raquo;</a>
                            </div>

                        @endif

                    </div>
                </div>
            </div>
        </section>
    </main>


@endsection
@section('scripts')
    <script>
        $('.qty-up').on('click', function(event) {
            event.preventDefault();
            const qtyel = $(this).prev();
            var qtyval = parseInt(qtyel.text());
            if (qtyval >= 10) {
                return;
            }
            qtyval = qtyval + 1;
            $(this).prev().text(qtyval);
            
            updateCart(qtyel.data('id'), qtyval);
        });
        $('.qty-down').on('click', function(event) {
            event.preventDefault();
            const qtyel = $(this).next();
            var qtyval = parseInt(qtyel.text());
            if (qtyval == 1) {
                return;
            }
            qtyval = qtyval - 1;
            $(this).next().text(qtyval);
            updateCart(qtyel.data('id'), qtyval);

        });

        function updateCart(rowid, qty) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{ route('cart.update') }}",
                type: "post",
                data: {
                    'rowId': rowid,
                    'qty': qty
                },
                datatype: 'json',
                success: function(response) {
                    console.log(response);
                    $('#' + rowid).find('.subtotal').text('$' + response[0]);
                    $('#cartsubtotal').text(response[1]);
                    $('#carttotal').text(response[2]);
                },
                error: function(res) {
                    var errors = res.responseJSON.errors;
                    console.log(errors);

                }
            });
        }



        function deleteItem(rowid) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{ route('cart.delitem') }}",
                type: "post",
                data: {
                    'rowId': rowid,
                },
                datatype: 'json',
                success: function(response) {
                    console.log(response);
                    $('#cartsubtotal').text(response[0]);
                    $('#carttotal').text(response[1]);
                    $('#cartitemscount').text(response[2]);
                },
                error: function(res) {
                    var errors = res.responseJSON.errors;
                    console.log(errors);

                }
            });
        }
        $(document).on('click', '#clearcart', function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{ route('cart.destroy') }}",
                type: "post",
                datatype: 'json',
                success: function(response) {
                    console.log(response);
                    if (response === true) {
                        location.reload();
                    }
                },
                error: function(res) {
                    var errors = res.responseJSON.errors;
                    console.log(errors);

                }
            });
        });


        $(document).on('submit', '#applycouponForm', function(e) {
            e.preventDefault();

            const coupon = e.target.Coupon.value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{ route('applycoupon') }}",
                type: "post",
                data: {
                    coupon: coupon
                },
                datatype: 'json',
                success: function(response) {
                    console.log(response);
                    if (response === true) {
                        location.reload();
                    } else {
                        $('#couponerror').text('*' + response);
                    }
                },
                error: function(res) {
                    var errors = res.responseJSON.errors;
                    console.log(errors);

                }
            });
        });
    </script>
@endsection
