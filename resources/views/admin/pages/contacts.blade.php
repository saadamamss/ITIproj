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
                                    <a href="{{ route('contact.index') }}">contacts</a>
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
                            <h3 class="card-title" align="center">contacts Datatable</h3>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>name</th>
                                            <th>email</th>
                                            <th>subject</th>
                                            <th>message</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse (App\Models\Contact::get() as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->subject }}</td>
                                                <td>{{ $item->message }}</td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm editcontacts" disabled
                                                        data-id='{{ $item->id }}'>reply (comming soon)</button>
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

    </div>

    @endsection
