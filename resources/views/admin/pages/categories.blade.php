@extends('admin.adminlayout.app')

@section('content')
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center flex-row-reverse">
                    <button type="button" class="btn btn-primary" id="addNewcategory">
                        Add New category
                    </button>
                    <div class="me-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admindashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('categories') }}">Categories</a>
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
                            <h3 class="card-title" align="center">Categories Datatable</h3>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Name</th>
                                            <th>no.of Products</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ count($item->products) }}</td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm editcategories"
                                                        data-id='{{ $item->id }}'>Edit</button>
                                                    <button class="btn btn-danger btn-sm delcategory"
                                                        data-id='{{ $item->id }}'>del</button>
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
        <div class="modal fade" id="addcategoryModal" tabindex="-1" role="dialog" aria-labelledby="addcategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addcategoryModalLabel">New category</h5>
                    </div>
                    <div class="modal-body border-bottom px-0">
                        <form action="{{ route('catg.add') }}" method="post" enctype="multipart/form-data"
                            id="addcategoryForm">
                            @csrf
                            <div class="inputfields px-4">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                        required autofocus />
                                    <span class="error text-danger" id="error_name"></span>
                                </div>

                                <div class="form-group">
                                    <label for="image">image:</label>
                                    <input type="file" id="image" name="image"
                                        class="form-control @error('image') is-invalid @enderror"
                                        value="{{ old('image') }}" required />
                                    <span class="error text-danger" id="error_image"></span>
                                </div>


                                <input type="hidden" id="category_id" name="category_id" />
                            </div>
                            <div class="d-flex justify-content-end px-4 border-top pt-3">
                                <button type="button" class="btn btn-secondary mx-1" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary mx-1" name="submit" value="Add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @section('scripts')
        <script>
            const categories = {{ Js::from($categories) }}
            const form = document.querySelector("#addcategoryForm");


            $(document).on('click', '.delcategory', function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });
                $.ajax({
                    url: "{{ route('catg.del') }}",
                    type: "delete",
                    data: {
                        id: $(this).data('id')
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
            $('#addcategoryForm').on('submit', function(e) {
                e.preventDefault();

                const data = $(this).serialize();
                const url = $(this).attr('action');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });
                $.ajax({
                    url: url,
                    type: "post",
                    data: data,
                    datatype: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response === true) {
                            location.reload();
                        }
                    },
                    error: function(res) {
                        var errors = res.responseJSON.errors;
                        Object.keys(errors).forEach(err => {
                            $(`#error_${err}`).text('*' + errors[err][0]);
                        });

                    }
                });

            });

            $('#addNewcategory').on('click', function() {
                form.action = `{{ route('catg.add') }}`;
                form.submit.value = 'Add';
                form.reset();
                $('.error').text("");
                $('#addcategoryModalLabel').text('Add New category');
                showmodal();
            });


            $(document).on('click', '.editcategories', function() {
                const id = $(this).data('id');
                var category;
                categories.forEach(element => {
                    if (element.id == id) {
                        category = element;
                        return;
                    }
                });

                if (category) {
                    form.elements.name.value = category.name;
                    form.action = `{{ route('catg.edit') }}`;
                    form.elements.submit.value = 'Edit';
                    form.elements.category_id.value = category.id;

                    $('#addcategoryModalLabel').text('Edit category');
                    showmodal();
                } else {
                    console.log('not found');
                }


            });
        </script>

        <script>
            function showmodal() {
                $('#addcategoryModal').modal('show');
            }

            function closemodal() {
                $('#addcategoryModal').modal('hide');
            }
        </script>
    @endsection
@endsection
