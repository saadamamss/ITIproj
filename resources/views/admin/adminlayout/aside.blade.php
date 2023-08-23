<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admindashboard') }}"
                        aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                            class="hide-menu">Home</span></a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('mainsettings') }}"
                        aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Main
                            Settings</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('categories') }}"
                        aria-expanded="false"><i class="mdi mdi-receipt"></i><span
                            class="hide-menu">Categories</span></a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('subcategories') }}"
                        aria-expanded="false"><i class="mdi mdi-receipt"></i><span
                            class="hide-menu">Sub-Categories</span></a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('products') }}"
                        aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Products</span></a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('gallery.index') }}"
                        aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Gallery</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('coupons.index') }}"
                        aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Coupons</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('reviews.index') }}"
                        aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Reviews</span></a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('orders.index') }}"
                        aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Orders</span></a>
                </li>



                {{--
          <li class="sidebar-item">
            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
              aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Employees </span></a>
            <ul aria-expanded="false" class="collapse first-level">
              <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> All
                    Employees </span></a>
              </li>
              <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Add
                    Employee </span></a>
              </li>
            </ul>
          </li>
          --}}
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
