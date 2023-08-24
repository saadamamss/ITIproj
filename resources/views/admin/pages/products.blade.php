@extends('admin.adminlayout.app')

@section('content')
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center flex-row-reverse">
                    <button type="button" class="btn btn-primary" id="addNewProduct">
                        Add New Product
                    </button>
                    <div class="me-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admindashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('products') }}">Products</a>
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
                            <h3 class="card-title" align="center">Products Datatable</h3>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="d-none">id</th>
                                            <th>Name</th>
                                            <th>category</th>
                                            <th>price</th>
                                            <th>Sale Price</th>
                                            <th>Stock</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $item)
                                            <tr>
                                                <td class="d-none">{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->category->name }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->sale_price }}</td>
                                                <td>{{ $item->stock }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm editproducts"
                                                        data-id='{{ $item->id }}'>Edit</button>
                                                    <button class="btn btn-danger btn-sm delproduct"
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
        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">New Product</h5>
                    </div>
                    <div class="modal-body border-bottom px-0">
                        <form action="{{ route('addproducts') }}" method="post" enctype="multipart/form-data"
                            id="addProductForm">
                            @csrf
                            <div class="inputfields px-4">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required autofocus />
                                    <span class="error text-danger" id="error_name"></span>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input type="text" id="price" name="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}" required />
                                    <span class="error text-danger" id="error_price"></span>

                                </div>
                                <div class="form-group">
                                    <label for="sale_price">Sale Price:</label>
                                    <input type="text" id="sale_price" name="sale_price"
                                        class="form-control @error('sale_price') is-invalid @enderror"
                                        value="{{ old('sale_price') }}" />
                                    <span class="error text-danger" id="error_sale_price"></span>
                                </div>

                                <div class="form-group">
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" id="quantity" name="quantity"
                                        class="form-control @error('quantity') is-invalid @enderror"
                                        value="{{ old('quantity') }}" required />
                                    <span class="error text-danger" id="error_quantity"></span>
                                </div>

                                <div class="form-group">
                                    <label for="product-desc">Description:</label>
                                    <textarea id="product-desc" rows="10" class="form-control"></textarea>
                                    <span class="error text-danger" id="error_desc"></span>
                                </div>

                                <div class="form-group">
                                    <label for="category">Category:</label>
                                    <select id="category" name="category" class="form-control">
                                        @forelse ($catgs as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @empty
                                            <option value="">No Categories</option>
                                        @endforelse
                                    </select>
                                    <span class="error text-danger" id="error_category"></span>
                                </div>

                                <div class="form-group">
                                    <label for="featured">Featured:</label>
                                    <select class="form-control" id="featured" name="featured">
                                        <option value="1">Featured</option>
                                        <option value="0">Not Featured</option>
                                    </select>
                                    <span class="error text-danger" id="error_featured"></span>
                                </div>

                                <div class="form-group">
                                    <label for="stock">Stock:</label>
                                    <select class="form-control" id="stock" name="stock">
                                        <option value="in">instock</option>
                                        <option value="out">outstock</option>
                                    </select>
                                    <span class="error text-danger" id="error_stock"></span>
                                </div>

                                <div class="form-group">
                                    <label for="product-image">Image:</label>
                                    <input type="file" class="form-control" id="product-image" name="productimage" />

                                    <span class="error text-danger" id="error_product_image"></span>
                                </div>

                                <div class="form-group">
                                    <label for="attached-images">Attached Images:</label>
                                    <input type="file" class="form-control" id="attached-images" name="attaches[]"
                                        multiple />
                                    <span class="error text-danger" id="error_attaches"></span>
                                </div>


                                <input type="hidden" id="product_id" name="product_id" />
                            </div>
                            <div class="d-flex justify-content-end px-4 border-top pt-3">
                                <button type="button" class="btn btn-secondary mx-1" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary mx-1" name="submit" value="ADD">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('scripts')
    <script src="https://cdn.tiny.cloud/1/k7j80u8n89o1osuuiirl91n2g4kb45gfqbm8c61xn91nvv8p/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        const products = {{ Js::from($products) }}

        const form = document.querySelector("#addProductForm");


        $(document).on('click', '.delproduct', function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{ route('productdel') }}",
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
        $('#addProductForm').on('submit', function(e) {
            e.preventDefault();
            const url = $(this).attr('action');

            var data = $(this).serialize();
            data += '&desc=' + tinymce.get("product-desc").getContent();

            var formData = new FormData();

            const productImage = document.querySelector('#product-image');
            const file = productImage.files[0];
            if (file) {
                data += '&product_image=' + file.name;
                formData.append('product_image', file, file.name);
            }


            const attachedImages = document.querySelector('#attached-images');
            const files = attachedImages.files;

            data += '&attaches=';

            if (files) {
                for (let i = 0; i < files.length; i++) {
                    formData.append('attaches[]', files[i], files[i].name);
                    data += files[i].name;
                    if (files.length - 1 == i) {
                        break;
                    }
                    data += ',';
                }
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                datatype: 'json',
                success: (response) => {
                    console.log(response);
                    if (response === true) {
                        uploadproductimages(formData);
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

        function uploadproductimages(formData) {

            $.ajax({
                type: "POST",
                url: "{{ route('uploadproductimage') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: (response) => {
                    if (response === true) {
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    alert(error);

                }
            });
        }

        $('#addNewProduct').on('click', function() {
            form.action = `{{ route('addproducts') }}`;
            form.submit.value = 'Add';
            form.reset();
            $('.error').text("");
            $('#addProductModalLabel').text('Add New Product');
            showmodal();
        });


        $(document).on('click', '.editproducts', function() {
            const id = $(this).data('id');
            var product;
            products.forEach(element => {
                if (element.id == id) {
                    product = element;
                    return;
                }
            });

            if (product) {
                form.elements.name.value = product.name;
                form.elements.price.value = product.price;
                form.elements.sale_price.value = product.sale_price;
                form.elements.quantity.value = product.quantity;

                tinymce.get("product-desc").setContent(product.desc);

                form.elements.category.value = product.cat_id;
                form.elements.featured.value = product.featured;
                form.elements.stock.value = product.stock;
                form.action = `{{ route('productedit') }}`;
                form.elements.submit.value = 'Edit';
                form.elements.product_id.value = product.id;

                $('#addProductModalLabel').text('Edit Product');
                showmodal();

            } else {
                console.log('not found');
            }

        });

        function showmodal() {
            $('#addProductModal').modal('show');
        }

        function closemodal() {
            $('#addProductModal').modal('hide');
        }



        tinymce.init({
            selector: '#product-desc',
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
                'table', 'emoticons', 'template', 'codesample'
            ],
            toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' +
                'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                'forecolor backcolor emoticons',
            menu: {
                favs: {
                    title: 'menu',
                    items: 'code visualaid | searchreplace | emoticons'
                }
            },
            menubar: 'favs file edit view insert format tools table',
            content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:16px}'
        });
    </script>

    @if ($errors->any())
        <script>
            showmodal();
        </script>
    @endif
@endsection
