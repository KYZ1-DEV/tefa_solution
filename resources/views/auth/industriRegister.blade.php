<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="short icon" href="{{ asset('logoC.png') }}">
    <title>Register Akun Industri</title>
    <link rel="stylesheet" href="{{ asset('auth/css/bootstrap.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- CSS langsung di-embed -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .header-top {
            background-color: #ffffff;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container-fluid {
            margin-top: 20px;
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 30px;
            padding: 20px;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e0e0e0;
            padding: 15px;
        }

        .card-header h6 {
            margin: 0;
            font-weight: 600;
        }

        .form-group label {
            font-weight: 500;
            color: #343a40;
        }

        .form-control {
            height: 40px;
            padding: 10px 15px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        .btn {
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #ffffff;
            border: none;
        }

        .btn-default {
            background-color: #ffffff;
            color: #343a40;
            border: 1px solid #007bff;
        }

        .footer-wrapper {
            background-color: #ffffff;
            padding: 15px 0;
            margin-top: 20px;
        }

        .footer-menu a {
            margin: 0 10px;
            color: #007bff;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .mt-25 {
            margin-top: 25px;
        }

        .mb-25 {
            margin-bottom: 25px;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header class="header-top">
        <nav class="navbar navbar-light">
            <img src="{{ asset('panel/img/Chlorine Digital Media.png') }}" alt="Logo" width="100px">
        </nav>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h6>Register Akun Industri</h6>
                    </div>
                    <div class="card-body">
                        <div class="horizontal-form">
                            <form method="POST" action="{{ route('auth.industries.register') }}">
                                @csrf
                                <!-- Form Fields -->
                                <div class="form-group row mb-25">
                                    <div class="col-sm-1 d-flex align-items-center">
                                        <label for="name" class="col-form-label">Nama Lengkap:</label>
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Nama Lengkap" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-25">
                                    <div class="col-sm-1 d-flex align-items-center">
                                        <label for="inputEmail" class="col-form-label">Email:</label>
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="email@example.com" required>
                                    </div>
                                    <div class="col-sm-1 d-flex align-items-center">
                                        <label for="inputEmailConfirmation" class="col-form-label">Konfirmasi Email:</label>
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="email" name="email_confirmation" class="form-control" id="inputEmailConfirmation" placeholder="email@example.com" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-25">
                                    <div class="col-sm-1 d-flex align-items-center">
                                        <label for="inputPassword" class="col-form-label">Password:</label>
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-1 d-flex align-items-center">
                                        <label for="inputPasswordConfirmation" class="col-form-label">Konfirmasi Password:</label>
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirmation" placeholder="Password" required>
                                    </div>
                                </div>

                               

                                <div class="form-group row mb-0">
                                    <div class="col-sm-12">
                                        <div class="layout-button mt-25">
                                            <a href="/register">
                                                <button type="button" class="btn btn-default">Cancel</button>
                                            </a>
                                            <button type="submit" class="btn btn-primary">Daftar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
