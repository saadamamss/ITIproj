@extends('admin.adminlayout.app')

@section('content')
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="page-breadcrumb">
      <div class="row">
        <div class="col-12 d-flex no-block align-items-center flex-row-reverse">
          <button class="btn btn-primary">Add New Product</button>
          <div class="me-auto text-end">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                  <a href="{{route('products')}}">Products</a>
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
                <table id="zero_config" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>price</th>
                      <th>Stock</th>
                      <th>Count</th>
                      <th>Color</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($products as $item)
                        <tr>
                          <td>{{$item['name']}}</td>
                          <td>{{$item['price']}}</td>
                          <td>{{$item['stock']}}</td>
                          <td>{{$item['count']}}</td>
                          <td>{{$item['color']}}</td>
                          <td>
                          <button class="btn btn-warning btn-sm">Edit</button>
                          <button class="btn btn-danger btn-sm">del</button>
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
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>price</th>
                      <th>Stock</th>
                      <th>Count</th>
                      <th>Color</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
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