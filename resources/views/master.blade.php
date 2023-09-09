<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AdminLTE 3 | Starter</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('adminassets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminassets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminassets/plugins/jqvmap/jqvmap.min.css')}}">
  <link rel="stylesheet"
    href="{{asset('adminassets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminassets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminassets/plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{asset('adminassets/plugins/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="{{asset('adminassets/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminassets/dist/css/custom.css')}}">
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<style>
    .nav-item a .fas.fa-file {
    margin-right: 7px; /* Adjust as needed */
}
.nav-item a .fas.fa-angle-left {
    margin-left: auto; /* Push it to the right */
}
.rtl {
    text-align: right !important;
}.nav-item {
    margin-bottom: 10px; /* Adjust as needed */
}
.nav-link {
    padding: 9px 5px; /* Adjust as needed */
}.nav-item.active {
    background-color: #f0f0f0; /* Adjust as needed */
}

</style>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

      <ul class="navbar-nav ">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item  d-sm-inline-block">
          <a href="{{route('home')}}" class="nav-link">Home</a>
        </li>
      </ul>


      <form class="form-inline ">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{asset('adminassets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">برنامج</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex ">
          <div class="image">
            <img src="{{asset('adminassets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
              alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">محمد</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{ route('supervisors.index') }}" class="nav-link">
                <i class="nav-icon fas fa-solid fa-user-tie"></i>                <p>
                  {{ __('المشرفين') }}
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('members.index') }}" class="nav-link">
                <i class="nav-icon fas fa-users "></i>
                <p>
                  {{ __('الأعضاء') }}
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('investments.index') }}" class="nav-link">
                <i class="nav-icon fas fa-university" style="color: #ffffffc5;"></i>
            {{ __('الصناديق') }}
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('subscribes.index') }}" class="nav-link">
                <i class="nav-icon fas fa-coins" style="color: #fafafac9;"></i>
                <p>
                  {{ __('المشتركين') }}
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('expense_fields.index') }}" class="nav-link">
                <i class="nav-icon fab fa-stack-exchange" ></i>
                <p>
                  {{ __('أوجه الصرف') }}
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('expenses.index') }}" class="nav-link">
                <i class="nav-icon fas a-solid fa-money-bill" style="color: rgba(255, 255, 255, 0.701);"></i>
                <p>
                  {{ __('المصروفات') }}
                </p>
              </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link ">
                    <i class="nav-icon left fas fa-solid fa-file"></i>
                    التقارير <!-- Report in Arabic -->
                    <i class=" right fas fa-angle-left"></i> <!-- Angle-left icon for indication -->
                </a>
                <ul class="nav nav-treeview ">
                    <li class="nav-item">
                        <a href="{{route('reports.members')}}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i> <!-- Some icon, replace with your choice -->
                            <p>الأعضاء</p> <!-- Name of the page -->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('reports.investment')}}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i> <!-- Some icon, replace with your choice -->
                            <p>الصناديق</p> <!-- Name of the page -->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('reports.supervisors')}}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i> <!-- Some icon, replace with your choice -->
                            <p>المشرفين</p> <!-- Name of the page -->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('reports.expenses')}}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i> <!-- Some icon, replace with your choice -->
                            <p>المصروفات</p> <!-- Name of the page -->
                        </a>
                    </li>
                </ul>
            </li>


          </ul>
        </nav>

        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper  ">
      @yield('content')

    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{asset('adminassets/plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('adminassets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('adminassets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('adminassets/dist/js/adminlte.min.js')}}"></script>

  <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>

  @yield('scripts')

</body>

</html>
