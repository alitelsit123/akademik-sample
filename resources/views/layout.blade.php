<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SMP 3 Maospati</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{url('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{url('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{url('plugins/summernote/summernote-bs4.min.css')}}">

  <!-- jQuery -->
  <script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{url('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{url('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{url('plugins/chart.js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{url('plugins/sparklines/sparkline.js')}}"></script>
  <!-- JQVMap -->
  <script src="{{url('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
  <script src="{{url('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{url('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{url('plugins/moment/moment.min.js')}}"></script>
  <script src="{{url('plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{url('plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{url('dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{url('dist/js/pages/dashboard.js')}}"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" @if(request()->segment(2) == 'induck' && request()->segment(3) == 'detail') style="margin-left:0;" @endif>
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button" @if(request()->segment(2) == 'induck' && request()->segment(3) == 'detail') style="display:none;" @endif><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/')}}" role="button">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        @if (auth()->user()->level == 'admin')
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>@if(request('q')) &nbsp; "{{request('q')}}" @endif
          </a>
          <div class="navbar-search-block">
            <form class="form-inline" method="GET" action="{{url('admin/search')}}">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" name="q" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link clock" href="#" role="button"></a>
        </li>
        <script>
        //   const moment = require('moment');
        //   require('moment/locale/id');
          function refreshClock() {
            setTimeout(() => {
              const now = moment().locale('id');
              const formattedDateTime = now.format('dddd, HH:mm:ss');
              $('.clock').text(formattedDateTime)
              refreshClock()
            }, 1000);
          }
          $(document).ready(function() {
            refreshClock()
          })
        </script>

      </ul>
    </nav>
    <!-- /.navbar -->
    @php
    $school = \App\Models\School::first();
    @endphp
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{url('/smp3maospatilogo-removebg.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light" style="word-break: break-all;">{{$school ? $school->name:'Akademik'}}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <div>
                <a href="#" class="d-block">{{auth()->user()->personalInformation->name}} <div class="badge badge-info">{{auth()->user()->level}}</div></a>
            </div>
          </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            @if (auth()->user()->level == 'admin')
            <li class="nav-item">
              <a href="{{url('admin')}}" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Home
                </p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon far fa-circle"></i>
                <p>
                  Manage
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('admin/school')}}" class="nav-link">
                    <i class="nav-icon fas fa-school"></i>
                    <p>
                      Sekolah
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/student')}}" class="nav-link">
                    <i class="nav-icon fas fa-graduation-cap"></i>
                    <p>
                      Siswa
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/mapel')}}" class="nav-link">
                    <i class="nav-icon fas fa-book-reader"></i>
                    <p>
                      Mapel
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/project')}}" class="nav-link">
                    <i class="nav-icon fas fa-book-reader"></i>
                    <p>
                      Project Pancasila
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/class')}}" class="nav-link">
                    <i class="nav-icon fas fa-university"></i>
                    <p>
                      Kelas
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/account')}}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      Akun
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{url('admin/report')}}" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Rapor
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('admin/induck')}}" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Buku Induk
                </p>
              </a>
            </li>
            @endif

            @if (auth()->user()->level == 'teacher')
            {{-- <li class="nav-item">
              <a href="{{url('teacher/student')}}" class="nav-link">
                <i class="nav-icon fas fa-graduation-cap"></i>
                <p>
                  Siswa
                </p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a href="{{url('teacher/evaluation')}}" class="nav-link">
                <i class="nav-icon fas fa-pen-square"></i>
                <p>
                  Nilai
                </p>
              </a>
            </li>
            @endif

            @if (auth()->user()->level == 'head_class')
            {{-- <li class="nav-item">
              <a href="{{url('teacher/student')}}" class="nav-link">
                <i class="nav-icon fas fa-graduation-cap"></i>
                <p>
                  Siswa
                </p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a href="{{url('head/evaluation')}}" class="nav-link">
                <i class="nav-icon fas fa-pen-square"></i>
                <p>
                  Nilai
                </p>
              </a>
            </li>
            @endif

            <li class="nav-item">
                <a href="{{url('logout')}}" class="nav-link">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">{{request()->segment(2) ? Str::ucfirst(request()->segment(2)): 'Home'}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">{{request()->segment(2)}}</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <section class="content" style="background: white; ">
        @yield('body')
      </section>
    </div>

    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
</body>

</html>
