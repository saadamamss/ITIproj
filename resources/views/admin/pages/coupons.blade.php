@extends('admin.adminlayout.app')

@section('content')
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center flex-row-reverse">
                    <button type="button" class="btn btn-primary" id="addNewcoupon">
                        Add New coupon
                    </button>
                    <div class="me-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admindashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('coupons.index') }}">coupons</a>
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
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title" align="center">coupons Datatable</h3>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Code</th>
                                            <th>Type</th>
                                            <th>Value</th>
                                            <th>Cart Value</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($coupons as $item)
                                            <tr>
                                                <td>{{ $item->code }}</td>
                                                <td>{{ $item->type }}</td>
                                                <td>{{ $item->value }}</td>
                                                <td>{{ $item->cart_value }}</td>
                                                <td>{{ $item->expire_date }}</td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm editcoupon"
                                                        data-couponid='{{ $item->id }}'>edit</button>

                                                    <button class="btn btn-danger btn-sm delcoupon"
                                                        data-couponid='{{ $item->id }}'>del</button>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">
                                                    <h2 align="center">No Data</h2>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page Content -->

        </div>
        <!-- End Container fluid -->


        {{-- --}}

        <!-- Modal -->
        <div class="modal fade" id="addcouponModal" tabindex="-1" role="dialog" aria-labelledby="addcouponModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addcouponModalLabel">New coupon</h5>
                    </div>
                    <div class="modal-body border-bottom px-0">
                        <form
                            action="@if (old('submit') === 'Edit') {{ route('coupon.update') }}@else{{ route('coupon.store') }} @endif"
                            method="post" id="addcouponForm">
                            @csrf
                            <div class="px-4">
                                <div class="form-group">
                                    <label for="code">Code :</label>
                                    <input type="text" id="code" name="code"
                                        class="form-control @error('code') is-invalid @enderror"
                                        value="{{ old('code') }}" required autofocus />
                                    @error('code')
                                        <div class="text-danger errormsg">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="type">type :</label>
                                    <select type="text" id="type" name="type"
                                        class="form-control @error('type')) is-invalid @enderror" required>
                                        <option value="fixed" @if (old('type') == 'fixed') selected @endif>Fixed
                                        </option>
                                        <option value="percent" @if (old('type') == 'percent') selected @endif>Percent
                                        </option>
                                    </select>


                                    @error('type')
                                        <div class="text-danger errormsg">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="coupon_val">coupon value :</label>
                                    <input type="number" id="coupon_val" name="coupon_val"
                                        class="form-control @error('coupon_val')) is-invalid @enderror"
                                        value="{{ old('coupon_val') }}" required />
                                    @error('coupon_val')
                                        <div class="text-danger errormsg">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cart_val">cart value :</label>
                                    <input type="number" id="cart_val" name="cart_val"
                                        class="form-control @error('cart_val')) is-invalid @enderror"
                                        value="{{ old('cart_val') }}" required />
                                    @error('cart_val')
                                        <div class="text-danger errormsg">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exp_date">expire date :</label>
                                    <input type="datetime-local" id="exp_date" name="exp_date"
                                        class="form-control @error('exp_date')) is-invalid @enderror"
                                        value="{{ old('exp_date') }}" required autofocus />
                                    @error('exp_date')
                                        <div class="text-danger errormsg">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" name="coupon_id" value="{{ old('coupon_id') }}">
                            </div>
                            <hr>
                            <div class="px-4 d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary mx-2" onclick="closemodal();">close</button>
                                <input type="submit" name="submit" class="btn btn-primary"
                                    value="@if (old('submit')) {{ old('submit') }}@else{{ __('Add') }} @endif">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @section('scripts')
        <script>
            const coupons = {{ Js::from($coupons) }}
            const form = document.querySelector("#addcouponForm");


            $('#addNewcoupon').on('click', function() {
                //form.reset();
                $('#addcouponForm .form-control').val('');
                $('#addcouponForm .is-invalid').removeClass("is-invalid");
                $('#addcouponForm .errormsg').text("");
                form.action = `{{ route('coupon.store') }}`;
                form.submit.value = 'Add';

                $('#addcouponModalLabel').text('Add New coupon');
                showmodal();

            });


            $(document).on('click', '.editcoupon', function() {
                const id = $(this).data('couponid');
                var coupon;
                coupons.forEach(element => {
                    if (element.id == id) {
                        coupon = element;
                        return;
                    }
                });

                if (coupon) {
                    form.elements.code.value = coupon.code;
                    form.elements.type.value = coupon.type;
                    form.elements.coupon_val.value = coupon.value;
                    form.elements.cart_val.value = coupon.cart_value;
                    form.elements.exp_date.value = coupon.expire_date;
                    form.action = `{{ route('coupon.update') }}`;
                    form.elements.submit.value = 'Edit';
                    form.elements.coupon_id.value = coupon.id;

                    $('.errormsg').text("");
                    $('#addcouponForm .is-invalid').removeClass('is-invalid');
                    $('#addcouponModalLabel').text('Edit coupon');
                    showmodal();

                } else {
                    console.log('not found');
                }


            });

            $(document).on('click', '.delcoupon', function() {
                const id = parseInt($(this).data('couponid'));
                if (confirm('Are you sure to delete this coupon?')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });
                    $.ajax({
                        url: "{{ route('coupon.destroy') }}",
                        type: "delete",
                        data: {
                            id: id
                        },
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

                }
            });

            function showmodal() {
                $('#addcouponModal').modal('show');
            }

            function closemodal() {
                $('#addcouponModal').modal('hide');
            }
        </script>


        @if ($errors->any())
            <script>
                showmodal();
            </script>
        @endif
    @endsection
@endsection
