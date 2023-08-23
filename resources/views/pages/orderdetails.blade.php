@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> orders
                </div>
            </div>
        </div>
        <section class="mb-50">
            <div class="container">
                <div class="row">

                    <h2 class="py-5">Order Details</h2>
                    <div class="col-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>no</th>
                                    <th>name</th>
                                    <th>quantity</th>
                                    <th>price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orderitems as $key=>$item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <img width="100px"
                                                src="{{ asset('assets/imgs/shop') . '/' . $item->product->image }}"
                                                alt="">
                                            <a
                                                href="{{ route('product.details', $item->product->slug) }}">{{ $item->product->name }}</a>
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>${{ $item->price }}</td>
                                    </tr>
                                @empty
                                    <h3 align="center">No Orders</h3>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
