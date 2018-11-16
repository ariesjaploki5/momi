<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Momi | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Momi | Dashboard</title>
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
            <a href="../home" class="brand-link text-center">
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
                <a href="#" class="d-block">{{ Auth::user()->email }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="../home" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie teal"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../screenings" class="nav-link">
                        <i class="nav-icon fab fa-wpforms teal"></i>
                        <p>Screening</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../requestings" class="nav-link">
                        <i class="nav-icon fas fa-notes-medical teal"></i>
                        <p>Milk Requests</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="../#" class="nav-link">
                    <i class="nav-icon fas fa-cogs teal"></i>
                        <p>
                            Management
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="..//milks" class="nav-link">
                                <i class="nav-icon fas fa-tint green"></i>
                                <p>Milks</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="..//questions" class="nav-link">
                                <i class="nav-icon fas fa-question-circle green"></i>
                                <p>Screening Questions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../tests" class="nav-link">
                                <i class="nav-icon fas fa-vial green"></i>
                                <p>Medical Tests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../conditions" class="nav-link">
                                <i class="nav-icon fas fa-tablets green"></i>
                                <p>Medical Conditions</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-users-cog teal"></i>
                    <p>
                        Users
                        <i class="right fa fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(Auth::user()->type === 'admin')
                            <li class="nav-item">
                            <a href="../adminadmins" class="nav-link">
                                <i class="nav-icon fas fa-user-cog green"></i>
                                <p>Admins</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item has-treeview">
                            <a href="../#" class="nav-link">
                            <i class="nav-icon fas fa-user-md teal"></i>
                                <p>
                                    Staff
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                 
                                <li class="nav-item">
                                    <a href="../doctors" class="nav-link">
                                        <i class="nav-icon fas fa-user-md green"></i>
                                        <p>Doctors</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../nurses" class="nav-link">
                                        <i class="nav-icon fas fa-user-md green"></i>
                                        <p>Nurses</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="../staff" class="nav-link">
                                        <i class="nav-icon fas fa-user-md green"></i>
                                        <p>Staff</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users teal"></i>
                                <p>
                                    Clients
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                 <li class="nav-item">
                                    <a href="../donors" class="nav-link">
                                        <i class="nav-icon fas fa-user green"></i>
                                        <p>Donors</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../recipients" class="nav-link">
                                        <i class="nav-icon fas fa-user green"></i>
                                        <p>Recipients</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../candidates" class="nav-link">
                                        <i class="nav-icon fas fa-user green"></i>
                                        <p>Candidates</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href=" #" class="nav-link">
                        <i class="nav-icon fas fa-scroll teal"></i>
                        <p>
                            Reports
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../requestreports" class="nav-link">
                                <i class="nav-icon fas fa-scroll green"></i>
                                <p>Milk Request</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../donationreports" class="nav-link">
                                <i class="nav-icon fas fa-scroll green"></i>
                                <p>Milk Donation</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="../profile1" class="nav-link">
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

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.0-alpha
            </div>
            <strong>Copyright &copy; 2014-2018 <a href="../http://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

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
<script>
    $(function() {
    $('nav a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active text-secondary');
    });
</script>
@include('sweetalert::alert')
</body>
</html>
