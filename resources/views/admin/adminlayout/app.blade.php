<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Shop</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta name="keywords"
    content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template" />
  <meta name="description"
    content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework" />
  <meta name="robots" content="noindex,nofollow" />
  <title>Matrix Admin Lite Free Versions Template by WrapPixel</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('adminassets/images/favicon.png')}}" />
  <!-- Custom CSS -->
  <!-- <link rel="stylesheet" href="{{asset('adminassets/css/bootstrap.min.css')}}">
   -->
  <link href="{{asset('adminassets/css/style.min.css')}}" rel="stylesheet" />
  <link href="{{asset('adminassets/css/dataTables.bootstrap4.css')}}" rel="stylesheet" />
</head>

<body>

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

    @include('admin.adminlayout.head')
    @include('admin.adminlayout.aside')
    
    @yield('content')

    @include('admin.adminlayout.footer')

    </div>

    <script src="{{asset('adminassets/js/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('adminassets/js/bootstrap.bundle.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('adminassets/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('adminassets/js/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('adminassets/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('adminassets/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('adminassets/js/custom.min.js')}}"></script>
  
    <!-- this page js -->
    <script src="{{asset('adminassets/js/datatables.min.js')}}"></script>

    <script>
      /****************************************
       *       Basic Table                   *
       ****************************************/
      $("#zero_config").DataTable();
    </script>

    @yield('scripts')
</body>

</html>