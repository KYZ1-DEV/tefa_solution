<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="short icon" href="{{ asset('logoC.png') }}">
    <title>Daftar Webite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
</head>
<body  style="background-image: linear-gradient( #560ae35e, #4b1cb7);">

    <!-- Navbar with logo -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" >
        <div class="container-fluid">
            <a class="navbar-brand" style="padding-left: 40px;" href="/home"> 
                <img src="{{ asset('panel/img/Chlorine Digital Media.png') }}" alt="Logo" width="80" height="80" class="d-inline-block align-text-top">
            </a>
            <h4>Chlorine Agency</h4>
        </div>
    </nav>

    <div class="container mt-1">
        <div class="row justify-content-center">
            <h2 class="text-center mb-4 text-black">Pendaftaran CSR Website</h2>
            <div class="col-lg-5 col-md-6 col-sm-12 mb-4 d-flex align-items-stretch">
                <div class="card shadow flex-fill">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="text-center">
                            <img src="{{ asset('panel/img/graduation.png') }}" alt="Akun Perorangan" class="rounded-circle profile-img">
                            <h5 class="card-title mt-3">Akun Sekolah</h5>
                            <p class="card-text">
                                Jenis layanan yang dapat diakses adalah sebagai berikut
                                <ul type="none">
                                    
                                    <li>Akses profile</li>
                                    <li>Akses Monitoring bantuan</li>
                                    <li>Akses laporan</li>
                                </ul>
                            </p>
                        </div>
                        <a href="{{ route('register.schools.show') }}" class="btn register-btn mt-auto">Register</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12 mb-4 d-flex align-items-stretch">
                <div class="card shadow flex-fill">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="text-center">
                            <img src="{{ asset('panel/img/vaccine.png') }}" alt="Akun Badan Usaha" class="profile-img">
                            <h5 class="card-title mt-3">Akun Industri</h5>
                            <p class="card-text">
                                Jenis layanan yang dapat diakses adalah sebagai berikut
                                <ul type="none" >
                                    <li>Akses profile</li>
                                    <li>Akses monitoring bantuan</li>
                                    <li>Akses list sekolah</li>
                                    <li>Akses memberi bantuan</li>
                                    
                                </ul>
                            </p>
                        </div>
                        <a href="{{ route('register.industries.show') }}" class="btn register-btn mt-auto">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-light text-center text-lg-start">
        <div class="container p-4">
            <div class="text-center p-3">
                © 2024 Copyright:
                <a class="text-dark" href="https://www.instagram.com/tefa_solution/">Tefa_Solution</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
