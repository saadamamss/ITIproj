@extends('admin.adminlayout.app')

@section('content')
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center flex-row-reverse">
                    <div class="me-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admindashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('orders.index') }}">orders</a>
                                </li>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bread crumb -->

        <!-- Container fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2>Order Info</h2>
                    <table class="table table-striped table-primary">
                        <tbody>
                            <tr>
                                <td>firstname</td>
                                <td>{{ $order->firstname }}</td>
                                <td>lastname</td>
                                <td>{{ $order->lastname }}</td>
                            </tr>

                            <tr>
                                <td>email</td>
                                <td>{{ $order->email }}</td>

                                <td>mobile</td>
                                <td>{{ $order->mobile }}</td>
                            </tr>

                            <tr>
                                <td>country</td>
                                <td>{{ $order->country }}</td>
                                <td>city</td>
                                <td>{{ $order->city }}</td>
                            </tr>

                            <tr>
                                <td>line1</td>
                                <td>{{ $order->line1 }}</td>
                                <td>line2</td>
                                <td>{{ $order->line2 }}</td>
                            </tr>

                            <tr>
                                <td>zipcode</td>
                                <td>{{ $order->zipcode }}</td>

                                <td>Status</td>
                                <td>
                                    <select name="orderstatus" id="" class=""
                                        onchange="changeOrderStatus(event)">
                                        <option @if ($order->status == 'ordered') selected @endif value="ordered">ordered
                                        </option>

                                        <option @if ($order->status == 'confirm') selected @endif value="confirm">confirm
                                        </option>
                                        <option @if ($order->status == 'withpost') selected @endif value="withpost">withpost
                                        </option>

                                        <option @if ($order->status == 'inway') selected @endif value="inway">in way
                                        </option>
                                        <option @if ($order->status == 'delivered') selected @endif value="delivered">
                                            delivered
                                        </option>
                                        <option @if ($order->status == 'canceled') selected @endif value="canceled">canceled
                                        </option>


                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td>subtotal</td>
                                <td>{{ $order->subtotal }}</td>
                                <td>total</td>
                                <td>{{ $order->total }}</td>
                            </tr>

                            <tr>
                                <td>tax</td>
                                <td>{{ $order->tax }}</td>
                                <td>discount</td>
                                <td>{{ $order->discount }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <h2>Transaction Info</h2>
                    <table class="table table-striped table-primary">
                        <tbody>
                            <tr>
                                <td>Mode</td>
                                <td>{{ $order->transaction->mode }}</td>
                            </tr>

                            <tr>
                                <td>Status</td>
                                <td>{{ $order->transaction->status }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <h2>Order Items</h2>
                    <table class="table table-striped table-primary">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($order->orderitem as $item)
                                <tr>
                                    <td>
                                        <img src="{{ asset('assets/imgs/shop') . '/' . $item->product->image }}"
                                            alt="" width="100px">
                                        {{ $item->product->name }}
                                    </td>

                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function changeOrderStatus(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{ route('order.status') }}",
                type: "post",
                data: {
                    orderId: '{{ $order->id }}',
                    status: e.target.value
                },
                datatype: 'json',
                success: function(response) {
                    console.log(response);
                    if (response === true) {
                        alert('status updated');
                    }
                },
                error: function(res) {
                    var errors = res.responseJSON.errors;
                    console.log(errors);

                }
            });
        }
    </script>
@endsection
