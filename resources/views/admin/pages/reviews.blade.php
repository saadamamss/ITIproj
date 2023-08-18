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
                                    <a href="{{ route('categories') }}">Reviews</a>
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
                            <h3 class="card-title" align="center">Reviews Datatable</h3>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>user</th>
                                            <th>product</th>
                                            <th>review</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($reviews as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->user->name ? $item->user->name : '---' }}</td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>{{ $item->review }}</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm delreview"
                                                        data-revid='{{ $item->id }}'>del</button>
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

    </div>



    @section('scripts')
        <script>
            $(document).on('click', '.delreview', function(e) {
                e.preventDefault();
                const id = $(this).data('revid');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });
                $.ajax({
                    url: "{{ route('review.destroy') }}",
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
            });
        </script>
    @endsection
@endsection
