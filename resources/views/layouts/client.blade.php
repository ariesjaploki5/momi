<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Momi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Momi</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
    <div id="app">

    
<!-- Site wrapper -->
    <div class="wrapper">
    <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars teal"></i> MoMi</a>
            </li>
            </ul>
            <!-- Right navbar links -->
            
        </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-5" id="main-sidebar">
            <!-- Brand Logo -->
            <a href="/home" class="brand-link text-center">
                {{-- <img src="" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
                <span class="brand-text font-weight-light">MoMi</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                {{-- <img src="" class="img-circle elevation-2"> --}}
                </div>
                <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="home" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie teal"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="profile2" class="nav-link">
                        <i class="nav-icon fas fa-cog teal"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt teal"></i><p>Log Out</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    
                    
                </div>
                <div class="col-sm-6">
                    
                    
                </div>
                </div>
            </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
        </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    <!-- /.control-sidebar -->
    </div>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('js/app.js') }}"></script>
@include('sweetalert::alert')
</body>
</html>
