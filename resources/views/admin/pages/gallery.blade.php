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
                                    <a href="{{ route('categories') }}">Gallery</a>
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
                            <h3 class="card-title" align="center"></h3>
                            <div class="">
                                <form
                                    action="@if (old('submit') == 'Edit') {{ route('gallery.update') }}@else{{ route('gallery.store') }} @endif"
                                    method="post" enctype="multipart/form-data" id="addGalleryForm">
                                    @csrf
                                    <div class="row m-0">
                                        <div class="form-group col-md-6 col-12">
                                            <label for="title">Title:</label>
                                            <input type="text" id="title" name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                value="@if (old('title')) {{ old('title') }}@else{{ null }} @endif" />
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label for="folding">folding:</label>
                                            <input type="text" id="folding" name="folding"
                                                class="form-control @error('folding') is-invalid @enderror"
                                                value="@if (old('folding')) {{ old('folding') }}@else{{ null }} @endif">
                                            @error('folding')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label for="head">head:</label>
                                            <input type="text" id="head" name="head"
                                                class="form-control @error('head') is-invalid @enderror"
                                                value="@if (old('head')) {{ old('head') }}@else{{ null }} @endif">
                                            @error('head')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label for="paragraph">paragraph:</label>
                                            <input type="text" id="paragraph" name="paragraph"
                                                class="form-control @error('paragraph') is-invalid @enderror"
                                                value="@if (old('paragraph')) {{ old('paragraph') }}@else{{ null }} @endif">
                                            @error('paragraph')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="form-group col-md-6 col-12">
                                            <label for="image">image:</label>
                                            <input type="file" id="image" name="image"
                                                class="form-control @error('image') is-invalid @enderror"
                                                value="@if (old('image')) {{ old('image') }}@else{{ null }} @endif" />
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="gallery_id" value="{{ old('gallery_id') }}">
                                    </div>
                                    <div class="d-flex justify-content-end px-4 border-top pt-3">
                                        <input type="submit" class="btn btn-primary mx-1" name="submit"
                                            value="@if (old('submit')) {{ old('submit') }}@else{{ __('Add') }} @endif">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-title py-3">
                            <h2 align="center">Gallery</h2>
                        </div>
                        <div class="card-body">
                            <div class="row m-0">
                                <div class="controll px-2">
                                    <p class="p-2" style="display: none" id="deletemultible" data-toggle="tooltip"
                                        data-placement="right" title="Delete selected images">
                                        <button type="button" class="btn btn-primary" id="deletemulti"
                                            onclick="deleteMultiFile()"><i class="fa fa-trash"></i></button>
                                    </p>

                                </div>

                            </div>
                            <div class="row m-0">

                                @forelse ($galleries as $item)
                                    <div class="img-card col-md-4 col-sm-6 col-12">
                                        <p>
                                            <input type="checkbox" class="form-check-input" name="photos[]"
                                                value="{{ $item->id }}" onchange="changearray(this)" />
                                            <span>
                                                <button class="btn btn-sm btn-warning editphoto"
                                                    data-id="{{ $item->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <button class="btn btn-sm btn-danger delphoto"
                                                    data-id="{{ $item->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </span>

                                        </p>

                                        <div class="img">

                                            <img src="{{ asset($item->path . '/' . $item->image) }}" width="100%"
                                                height="200px" alt="">



                                        </div>
                                        <div class="img-title text-center py-2">
                                            <span>{{ $item->title }}</span>
                                        </div>
                                    </div>

                                @empty

                                    <h5 align="center">NO Images In Gallery</h5>
                                @endforelse


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page Content -->

        </div>
        <!-- End Container fluid -->

        <div id="confirmModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this file?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" onclick="deleteFile()">Delete</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

    @section('scripts')
        <script>
            const form = document.querySelector("#addGalleryForm");
            const galleries = ['saad']; //{{-- Js::from($galleries) --}};

            $(document).on('click', ".delphoto", function() {
                $('#confirmModal').modal({
                    backdrop: 'static',
                    keyboard: false
                }, 'show');

                $("#confirmModal").data('id', $(this).data('id'));

            });

            function deleteFile() {
                const id = parseInt($("#confirmModal").data('id'));
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });
                $.ajax({
                    url: "{{ route('gallery.destroy') }}",
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

            $(document).on('click', ".editphoto", function() {
                var gall = [];
                const id = parseInt($(this).data('id'));
                galleries.data.forEach(element => {
                    if (element.id == id) {
                        gall = element;
                        return;
                    }
                });

                if (gall) {
                    console.log(gall);

                    form.elements.gallery_id.value = gall.id;
                    form.elements.title.value = gall.title;
                    form.elements.head.value = gall.head;
                    form.elements.paragraph.value = gall.paragraph;
                    form.elements.folding.value = gall.path.replace('assets/imgs/', "");
                    form.elements.submit.value = 'Edit';
                    form.action = "{{ route('gallery.update') }}";
                }

            });

            var imgIds = [];

            function changearray(el) {

                if (el.checked) {
                    imgIds.push(parseInt(el.value));
                } else {
                    imgIds.splice(imgIds.indexOf(parseInt(el.value)), 1);
                }

                console.log(imgIds);
                if (imgIds.length > 0) {
                    $('#deletemultible').css('display', "inline-block");
                } else {
                    $('#deletemultible').css('display', "none");
                }

            }

            function deleteMultiFile() {
                if (confirm("Are you sure to delete the selected images?")) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });
                    $.ajax({
                        url: "{{ route('gallery.destroy.multi') }}",
                        type: "delete",
                        data: {
                            ids: imgIds
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
            }
        </script>
    @endsection


    <style>
        .img-card {
            position: relative;
            box-sizing: border-box;
        }

        .img-card p input {
            background-color: transparent;
        }

        .img-card p {
            position: absolute;
            width: 100%;
            left: 0px;
            padding: 10px 20px;
            margin: 0px;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .img-card p input,
        .img-card p .btn {
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.4s ease;
        }

        .img-card p input:checked,
        .img-card:hover p input,
        .img-card:hover p .btn {
            opacity: 1;
            transform: translateY(0px);
        }

        .controll {
            position: relative;

        }
    </style>
@endsection
