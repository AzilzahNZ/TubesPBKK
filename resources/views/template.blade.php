<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SIMPULS</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/logo_unib.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- Updated CSS for Layout and Centered Footer -->
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }

        .main {
            flex: 1 0 auto;
            min-height: calc(100vh - 160px);
            padding-bottom: 60px;
            transition: margin-left 0.3s ease-in-out;
        }

        .footer {
            flex-shrink: 0;
            background: #f6f9ff;
            padding: 20px 0;
            margin-top: auto;
            width: 100%;
            position: relative;
            bottom: 0;
            text-align: center;
            transition: margin-left 0.3s ease-in-out;
        }

        .footer .copyright,
        .footer .credits {
            text-align: center;
            width: 100%;
            padding: 5px 0;
        }

        #header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 997;
            transition: all 0.3s ease-in-out;
        }

        .sidebar {
            position: fixed;
            height: 100%;
            overflow-y: auto;
            transition: all 0.3s ease-in-out;
        }

        @media (min-width: 1200px) {
            body:not(.toggle-sidebar) #main {
                margin-left: 300px;
            }

            body:not(.toggle-sidebar) .footer {
                margin-left: 300px;
                width: calc(100% - 300px);
            }
        }

        /* When sidebar is toggled/hidden */
        body.toggle-sidebar #main {
            margin-left: 0;
        }

        body.toggle-sidebar .footer {
            margin-left: 0;
            width: 100%;
        }

        /* Responsive adjustments */
        @media (max-width: 1199px) {
            .footer {
                margin-left: 0;
                width: 100%;
            }

            #main {
                margin-left: 0;
            }
        }

        /* Custom Styles */
        .form-input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-button {
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            color: white;
        }

        .form-button-primary {
            background-color: #0d6efd;
            border: none;
        }

        .form-button-danger {
            background-color: #dc3545;
            border: none;
        }

        .table-header {
            background-color: #f8f9fa;
        }

        .table-cell {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .status-finish {
            color: #198754;
        }

        .status-pending {
            color: #fd7e14;
        }

        .alert-warning {
            text-align: center;
        }
 
        .form-label {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/logo_unib.png') }}" alt="">
                <span class="d-none d-lg-block">SIMPULS</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                @csrf
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle" href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>

                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex justify-content-end" href="#" data-bs-toggle="dropdown">
                <li><i class="bi bi-person-fill menu-icon"></i></li>
                <span class="d-none d-md-block dropdown-toggle ps-6" style="margin-right: 30px"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->name }}</h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item" href="/profile">
                            <i class="ti-settings text-primary"></i>
                            Profile
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Log Out</span>
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
                </li>
            </ul>
        </nav>
    </header>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            @if (Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard/admin') ? 'active' : '' }}" href="/dashboard/admin">
                        <i class="bi bi-clipboard2-fill menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin.manajemen-akun-pengguna') ? 'active' : '' }}"
                        href="/admin.manajemen-akun-pengguna">
                        <i class="bi bi-people-fill menu-icon"></i>
                        <span class="menu-title">Manajemen Akun Pengguna</span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->role == 'ormawa')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard/ormawa') ? 'active' : '' }}"
                        href="/dashboard/ormawa">
                        <i class="fa-solid fa-calculator menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role == 'ormawa')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('ormawa.pengajuan-surat') ? 'active' : '' }}"
                        href="/ormawa.pengajuan-surat">
                        <i class="fa-solid fa-user-group menu-icon"></i>
                        <span class="menu-title">Pengajuan Surat</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role == 'ormawa')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('ormawa.riwayat-pengajuan-surat') ? 'active' : '' }}"
                        href="/ormawa.riwayat-pengajuan-surat">
                        <i class="fa-solid fa-user-group menu-icon"></i>
                        <span class="menu-title">Riwayat Pengajuan Surat</span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->role == 'staff-kemahasiswaan')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard/staff-kemahasiswaan') ? 'active' : '' }}"
                        href="/dashboard/staff-kemahasiswaan">
                        <i class="fa-solid fa-calculator menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role == 'staff-kemahasiswaan')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('staff-kemahasiswaan.surat-masuk') ? 'active' : '' }}"
                        href="/staff-kemahasiswaan.surat-masuk">
                        <i class="fa-solid fa-user-group menu-icon"></i>
                        <span class="menu-title">Surat Masuk</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role == 'staff-kemahasiswaan')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('staff-kemahasiswaan.surat-keluar') ? 'active' : '' }}"
                        href="/staff-kemahasiswaan.surat-keluar">
                        <i class="fa-solid fa-user-group menu-icon"></i>
                        <span class="menu-title">Surat Keluar</span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->role == 'staff-tu')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard/staff-tu') ? 'active' : '' }}"
                        href="/dashboard/staff-tu">
                        <i class="fa-solid fa-calculator menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role == 'staff-kemahasiswaan' || Auth::user()->role == 'staff-tu')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('riwayat-surat') ? 'active' : '' }}"
                        href="/riwayat-surat">
                        <i class="fa-solid fa-user-group menu-icon"></i>
                        <span class="menu-title">Riwayat Surat</span>
                    </a>
                </li>
            @endif
        </ul>
    </aside>

    <main id="main" class="main">
        <section class="section dashboard">
            @yield('content')
        </section>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>2024</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            SIMPULS <a href="https://bootstrapmade.com/">PPL</a>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
