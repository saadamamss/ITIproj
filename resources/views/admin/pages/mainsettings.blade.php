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
                                    <a href="{{ route('categories') }}">MainSettings</a>
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
                            <h3 class="card-title" align="center">Main Settings</h3>
                            <div class="">
                                <form action="{{ route('mainsettings.edit') }}" method="post" enctype="multipart/form-data"
                                    id="addcategoryForm">
                                    @csrf
                                    <div class="inputfields px-4">



                                        <div class="form-group">
                                            <label for="siteName">Site Name:</label>
                                            <input type="text" id="siteName" name="siteName"
                                                class="form-control @error('siteName') is-invalid @enderror"
                                                value="@if (old('siteName')) {{ old('siteName') }}@else{{ $settings->siteName }} @endif" />
                                            @error('siteName')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="siteUrl">Site Url:</label>
                                            <input type="text" id="siteUrl" name="siteUrl"
                                                class="form-control @error('siteUrl') is-invalid @enderror"
                                                value="@if (old('siteUrl')) {{ old('siteUrl') }}@else{{ $settings->siteUrl }} @endif" />
                                            @error('siteUrl')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="siteDesc">Site Description:</label>
                                            <textarea id="siteDesc" name="siteDesc" rows="5" class="form-control @error('siteDesc') is-invalid @enderror">
@if (old('siteDesc'))
{{ old('siteDesc') }}@else{{ $settings->siteDesc }}
@endif
</textarea>
                                            @error('siteDesc')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" id="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="@if (old('email')) {{ old('email') }}@else{{ $settings->email }} @endif" />
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone:</label>
                                            <input type="text" id="phone" name="phone"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                value="@if (old('phone')) {{ old('phone') }}@else{{ $settings->phone }} @endif" />
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address:</label>
                                            <input type="text" id="address" name="address"
                                                class="form-control @error('address') is-invalid @enderror"
                                                value="@if (old('address')) {{ old('address') }}@else{{ $settings->address }} @endif" />
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="sitelogo">Site Logo:</label>
                                            <input type="file" id="sitelogo" name="sitelogo"
                                                class="form-control @error('sitelogo') is-invalid @enderror"
                                                value="@if (old('sitelogo')) {{ old('sitelogo') }}@else{{ $settings->sitelogo }} @endif" />
                                            @error('siteLogo')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="social">Social:</label>
                                            <input type="text" id="social" name="social"
                                                class="form-control @error('social') is-invalid @enderror"
                                                value="@if (old('social')) {{ old('social') }}@else{{ $settings->social }} @endif" />
                                            @error('social')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-end px-4 border-top pt-3">
                                        <input type="submit" class="btn btn-primary mx-1" name="submit" value="Edit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page Content -->

        </div>
        <!-- End Container fluid -->

    </div>
@endsection
