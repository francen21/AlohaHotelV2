<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Aloha Hotel') }}</title>

    <link rel="stylesheet" href="/css/app.css">

</head>

<body class="sidebar-mini layout-fixed" data-gr-c-s-loaded="true" style="height: auto;">
    <div class="wrapper" id="app">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <h1 class="m-0 text-dark">Home Page</h1>
            </ul>
            <!-- Right na/vbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @else

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="./images/hotel.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Aloha Hotel</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                                with font-awesome or any other icon font library -->
                        <!-- Nav Item - Pages Collapse Menu -->
                        @if(Gate::check('isFo') || Gate::check('isAdmin'))
                        <li class="nav-item">
                            <router-link to="/fo" class="nav-link collapsed">
                                <i class="nav-icon fas fa-server"></i>
                                <span> Front Panel</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link  to="/rs" class="nav-link collapsed">
                                <i class="nav-icon fas fa-concierge-bell"></i>
                                <span> Reservations</span>
                            </router-link>
                        </li>
                        @endif
                        @if(Gate::check('isHk') || Gate::check('isAdmin') || Gate::check('isFo'))
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="/hk">
                                <i class="nav-icon fas fa-broom"></i>
                                <span> House Keeping</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="/in">
                                <i class="nav-icon fas fa-truck-loading"></i>
                                <span> Inventory</span>
                            </a>
                        </li>
                        @endif
                        @if(Gate::check('isFo') || Gate::check('isAdmin'))
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="/gs">
                                <i class="nav-icon fas fa-id-badge"></i><!--    -->
                                <span> Guests</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="/rm">
                                <i class="nav-icon fas fa-hand-holding-usd"></i>
                                <span> Rate Management</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="/um">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <span> User Management</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <router-link  to="/fm" class="nav-link collapsed">
                                <i class="nav-icon fas fa-building"></i>
                                <span> Floor Management</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="/lg">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <span> User Log</span>
                            </a>
                        </li>
                        @if(Gate::check('isFo') || Gate::check('isAdmin'))
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="/rp">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <span> Reports</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">

                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <router-view></router-view>
                    <vue-progress-bar></vue-progress-bar>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">

            </div>
            <!-- Default to the left -->
            <strong>Aloha Hotel</strong>
        </footer>
    </div>
    <!-- ./wrapper -->
    @auth
    <script>
         window.user = @json(auth()->user())
    </script>

    @endauth
    <!-- REQUIRED SCRIPTS -->

    <script src="/js/app.js"></script>

</body>

</html>
