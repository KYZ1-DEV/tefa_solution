<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="short icon" href="{{ asset('logoC.png') }}">
    <title>
        {{ Request::segment(1) == 'industries' ? 'Dashboad Industri' : (Request::segment(1) == 'admin' ? 'Dashboard Admin' : (Request::segment(1) == 'schools' ? 'Dashboard Sekolah' : 'Web Bantuan')) }}
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        .btn-sidebar {
            border-radius: 30px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            color: #7b2cbf;
        }

        .btn-sidebar:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
            color: #7b2cbf;
        }

        .aktif {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
            background: linear-gradient(to right, #6A0DAD, #e6e6fa63) !important;
        }

        .btn-card {
            border-radius: 20px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            color: #602fb5;
        }

        .btn-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
            color: #602fb5;
        }

        #content {
            overflow-y: auto;
            height: calc(100vh - 150px); /* Sesuaikan tinggi konten sesuai kebutuhan */
            scrollbar-width: thin;
            scrollbar-color: #ccc #f1f1f1;
        }

        #content::-webkit-scrollbar {
            width: 6px;
        }

        #content::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #content::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 10px;
        }

        #content::-webkit-scrollbar-thumb:hover {
            background: #aaa;
        }
        
           /* Responsive font size adjustment */
    @media (max-width: 576px) { /* Bootstrap's breakpoint for small screens */
        #welcome-message {
            font-size: 1.5rem; /* Smaller font size for mobile */
        }
    }

    @media (min-width: 576px) and (max-width: 768px) { /* Tablet breakpoint */
        #welcome-message {
            font-size: 2rem; /* Slightly larger for tablets */
        }
    }

    @media (min-width: 768px) {
        #welcome-message {
            font-size: 3rem; /* Default size for larger screens */
        }
    }

    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-image: linear-gradient(50deg, #7b2cbf, #4b1cb7);" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" style="background-color: #ffff !important;" href="/">
                <div class="sidebar-brand-icon rotate-n-1">
                    <img src="{{ asset('panel/img/Chlorine Digital Media.png') }}" height="80" width="80" alt="" srcset="">
                </div>
                <div class="sidebar-brand-text mx-3"></div>
            </a>
            @yield('navItem')
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 sticky-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ Auth::user()->gambar ? asset('storage/photo-user/' . Auth::user()->gambar) : asset('gambar/user.png') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="@yield('profile')">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                
                @yield('main')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Tefa solution</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin untuk Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" Jika kamu ingin keluar dari aplikasi
                    <div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('auth.logout') }}" method="post">
                        @csrf
                        <button class="btn btn-primary" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mengambil elemen dengan class 'alert-success'
            var successAlerts = document.getElementsByClassName('alert-success');

            // Pastikan ada elemen dengan class 'alert-success'
            if (successAlerts.length > 0) {
                // Ambil elemen pertama jika ada lebih dari satu
                var successAlert = successAlerts[0];

                setTimeout(function() {
                    successAlert.classList.add('show');
                }, 100);

                setTimeout(function() {
                    successAlert.classList.remove('show');
                    successAlert.classList.add('fade-out');

                    setTimeout(function() {
                        successAlert.classList.add('hide');
                        successAlert.style.display = 'none';
                    }, 500);
                }, 4500);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Mengambil elemen dengan class 'alert-success'
            var dangerAlert = document.getElementsByClassName('alert-danger');

            // Pastikan ada elemen dengan class 'alert-success'
            if (dangerAlert.length > 0) {
                // Ambil elemen pertama jika ada lebih dari satu
                var dangerAlert = dangerAlert[0];

                setTimeout(function() {
                    dangerAlert.classList.add('show');
                }, 100);

                setTimeout(function() {
                    dangerAlert.classList.remove('show');
                    dangerAlert.classList.add('fade-out');

                    setTimeout(function() {
                        dangerAlert.classList.add('hide');
                        dangerAlert.style.display = 'none';
                    }, 500);
                }, 7500);
            }
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('dashboard/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('dashboard/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('dashboard/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('dashboard/js/demo/chart-pie-demo.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('dashboard/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('dashboard/js/demo/datatables-demo.js') }}"></script>
</body>

</html>
