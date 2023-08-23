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

                    <h2 class="py-5">Your Orders</h2>

                    <div class="col-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>no</th>
                                    <th>total</th>
                                    <th>status</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $key=>$order)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td>
                                            <span
                                                class="badge @if ($order->status === 'canceled') bg-danger @else @if ($order->status === 'deliverd') bg-success @else bg-primary @endif  @endif">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary">show</a>
                                        </td>
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
