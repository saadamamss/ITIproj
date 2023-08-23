@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Checkout
                </div>
            </div>
        </div>
        <section class="mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="divider mt-50 mb-50"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-25">
                            <h4>Billing Details</h4>
                        </div>
                        <form method="post" id="checkoutform" action="{{ route('placeorder') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" required="" name="fname" placeholder="First name *"
                                    value="ehab">
                            </div>
                            <div class="form-group">
                                <input type="text" required="" name="lname" placeholder="Last name *"
                                    value="omar">
                            </div>
                            <div class="form-group">
                                <input required="" type="text" name="country" placeholder="State / Country *"
                                    value="Egypt">
                            </div>
                            <div class="form-group">
                                <input required="" type="text" name="city" placeholder="City / Town *"
                                    value="cairo">
                            </div>
                            <div class="form-group">
                                <input type="text" name="billing_address" required="" placeholder="Address *"
                                    value="tahrir">
                            </div>
                            <div class="form-group">
                                <input type="text" name="billing_address2" required="" placeholder="Address line2"
                                    value="tahrir">
                            </div>
                            <div class="form-group">
                                <input required="" type="text" name="zipcode" placeholder="Postcode / ZIP *"
                                    value="5050">
                            </div>
                            <div class="form-group">
                                <input required="" type="text" name="phone" placeholder="Phone *"
                                    value="+201014648199">
                            </div>
                            <div class="form-group">
                                <input required="" type="text" name="email" placeholder="Email address *"
                                    value="test@gmail.com">
                            </div>

                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>Payment</h5>
                                </div>
                                <div class="payment_option">
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" checked
                                            name="payment_option" id="exampleRadios3" value="cod">
                                        <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse"
                                            data-target="#cashOnDelivery" aria-controls="cashOnDelivery">Cash On
                                            Delivery</label>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" type="radio" disabled name="payment_option"
                                            id="exampleRadios4">
                                        <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse"
                                            data-target="#cardPayment" aria-controls="cardPayment">Card Payment</label>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" type="radio" disabled name="payment_option"
                                            id="exampleRadios5">
                                        <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse"
                                            data-target="#paypal" aria-controls="paypal">Paypal</label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-fill-out btn-block mt-30" type="submit">Place Order</button>

                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>Your Orders</h4>
                            </div>
                            <div class="table-responsive order_table text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::instance('cart')->content() as $item)
                                            <tr>
                                                <td class="image product-thumbnail"><img
                                                        src="{{ asset('assets/imgs/shop/') . '/' . $item->model->image }}"
                                                        alt="#"></td>
                                                <td>
                                                    <h5><a href="{{ $item->model->slug }}">{{ $item->name }}</a></h5>
                                                    <span class="product-qty">x {{ $item->qty }}</span>
                                                </td>
                                                <td>${{ $item->subtotal() }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th>SubTotal</th>
                                            <td class="product-subtotal" colspan="2">
                                                ${{ Cart::instance('cart')->subtotal() }}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td colspan="2"><em>Free Shipping</em></td>
                                        </tr>

                                        <tr>
                                            <th>Total</th>
                                            <td colspan="2" class="product-subtotal"><span
                                                    class="font-xl text-brand fw-900">${{ Cart::instance('cart')->total() }}</span>
                                            </td>
                                        </tr>
                                        @if (session('coupon'))
                                            <tr>
                                                <td>Total After Coupon</td>
                                                <td colspan="2" class="product-subtotal">
                                                    <span class="font-xl text-brand fw-900">
                                                        @if (session('coupon')->type === 'fixed')
                                                            ${{ number_format(preg_replace('/,/i', '', Cart::instance('cart')->total()) - session('coupon')->value, 2, '.', '') }}
                                                        @else
                                                            ${{ number_format(preg_replace('/,/i', '', Cart::instance('cart')->total()) * (session('coupon')->value / 100), 2, '.', '') }}
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
