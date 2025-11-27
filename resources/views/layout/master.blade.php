<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.head')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-1">Toko Kupiw</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{route('products.index')}}">
                    <i class="fas fa-fw fa-sitemap"></i>
                    <span>Products</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    <span>Log Out</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <ul>
                <a class="nav-link" id="openCart">
                    <i class="fas fa-shopping-cart fa-fw"></i>
                </a>
          </ul>

          <div class="topbar-divider d-none d-sm-block"></div>
        </nav>

                @yield('content')

                <!-- Cart Modal -->
                <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel">Keranjang Belanja</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items-body">
                            <tr><td colspan="4" class="text-center">Loading...</td></tr>
                        </tbody>
                        </table>

                    </div>
                    </div>
                </div>
                </div>
            </div>

            @include('layout.foot')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
</body>

</html>
