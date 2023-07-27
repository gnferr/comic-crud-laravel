<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    {{-- Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Admin</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href=" {{ asset('stisla/node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('stisla/node_modules/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('stisla/node_modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('stisla/node_modules/fullcalendar/dist/fullcalendar.css') }}">
    <link rel="stylesheet" href=" {{ asset('stisla/node_modules/izitoast/dist/css/iziToast.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('stisla/node_modules/flag-icon-css/css/flag-icon.css') }}">

    <script src=" {{ asset('stisla/node_modules/jquery/dist/jquery.min.js') }}"></script>

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href=" {{ asset('stisla/assets/css/style.css') }}">
    <link rel="stylesheet" href=" {{ asset('stisla/assets/css/components.css') }}">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <div class="d-sm-none d-lg-inline-block">Hi,tes</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="" class="dropdown-item has-icon">
                                <i class="far fa-user"></i>My Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="" class="dropdown-item has-icon text-danger" id="logout" data-confirm="Logout?|Are you sure?" data-confirm-yes="returnLogout()">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="">Stisla</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="">LS</a>
                    </div>
                    <ul class="sidebar-menu">
                      @include('layouts.admin.sidebar')
                    </ul>
                    {{-- <div class="sidebar-footer">
                        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                            <a href="" class="btn btn-primary btn-lg btn-block btn-icon-split">
                                <i class="fas fa-rocket"></i> Copyright
                            </a>
                        </div>
                    </div> --}}
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
              @yield('content')
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; <?= date('Y') ?>
                  </div>
        </div>

        </footer>
    </div>
    </div>

    <!-- General JS Scripts -->

  
    <script src="{{ asset('stisla/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/select2/dist/js/select2.min.js') }}"></script>

    <script src="{{ asset('stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('stisla/assets/js/stisla.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('stisla/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('stisla/assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
</body>

</html>