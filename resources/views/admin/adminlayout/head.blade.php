<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
      <div class="navbar-header" data-logobg="skin5">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <a class="navbar-brand" href="#">
          <!-- Logo icon -->
          <b class="logo-icon ps-2">
            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
            <!-- Dark Logo icon -->
            <img src="{{asset('adminassets/images/logo-icon.png')}}" alt="homepage" class="light-logo" width="25" />
          </b>
          <!--End Logo icon -->
          <!-- Logo text -->
          <span class="logo-text ms-2">
            <!-- dark Logo text -->
            <!-- <img src="assets/images/logo-text.png" alt="homepage" class="light-logo"/> -->
          </span>
        </a>
        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
            class="ti-menu ti-close"></i></a>
      </div>
      <!-- ============================================================== -->
      <!-- End Logo -->
      <!-- ============================================================== -->
      <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
        <!-- ============================================================== -->
        <!-- toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav float-start me-auto">
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
              data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
          </li>
        </ul>
        <!-- ============================================================== -->
        <!-- Right side toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav float-end">
          <li class="nav-item">
            <a href="javascript:void(0)" class="text-white d-inline-block">
              {{Auth::user()->name}}
            </a>
            /
           
              <form action="{{route('logout')}}" method="post" class="d-inline-block">
                @csrf
                <a class="text-white" href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
                  Logout
                </a>
              </form>
            
          </li>
        </ul>
      </div>
    </nav>
  </header>