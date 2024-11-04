<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CSR Website</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="short icon" href="{{ asset('logoC.png') }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Jost:wght@500;600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('panel/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('panel/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="{{ asset('panel/css/style.css') }}" rel="stylesheet">
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="51">
    <div class="container-fluid bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow" style="color: purple;width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0" id="home">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h3 class="m-0">Chlorine</h3>
                    <!-- <img src="logoC.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="#home" class="nav-item nav-link active">Home</a>
                        <a href="#service" class="nav-item nav-link">Services</a>
                        <a href="#join-us" class="nav-item nav-link">Join Us</a>
                        <a href="#the-founder" class="nav-item nav-link">The Founder</a>
                        <a href="#contact" class="nav-item nav-link">Contact</a>
                    </div>
                </div>
            </nav>

            <div class="container-fluid bg-primary hero-header">

                <div class="container px-lg-5">
                    <div class="row align-items-center"> 
                            <div class="col-lg-6 text-center text-lg-start">
                                <h1 class="text-white mb-2 animated slideInDown">Monitoring CSR</h1>
                                <p class="text-white pb-1 animated slideInDown">
                                    Aplikasi Web Monitoring CSR ini buat dan dikembangkan oleh tim tefa solution
                                    bersama PT Chlorine, sebagai alat untuk memantau dan mengelola program
                                    Corporate Social Responsibility (CSR). Aplikasi ini dirancang untuk
                                    memastikan transparansi, efektivitas, dan akuntabilitas dalam pelaksanaan 
                                    program CSR, khususnya bantuan yang diberikan kepada sekolah-sekolah yang
                                    bekerja sama dalam proyek ini.
                                </p>
                                <a href="{{ route('login') }}" class="btn btn-primary-gradient py-sm-3 px-4 px-sm-5 rounded-pill me-3 animated slideInLeft">Sign In</a>
                                <a href="{{ route('register.show') }}" class="btn btn-secondary-gradient py-sm-3 px-4 px-sm-5 rounded-pill animated slideInRight">Sign Up</a>
                            </div>


                            <div class="col-lg-6 d-flex justify-content-center justify-content-lg-end wow fadeInUp">
                                <img class="img-fluid" width="420" src="{{ asset('panel/img/Chlorine Digital Media.png') }}" alt="">
                            </div>
                    </div>
                </div>

            </div>
            
        </div>
        <!-- Navbar & Hero End -->

        

        <!-- Service Start -->
        <div class="container-fluid py-5" id="service">
            <div class="container py-5 px-lg-5">
                <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">Services</h1>
                </div>
                <div class="row gy-5 gx-4 justify-content-center">
                    <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                                <img src="{{ asset('panel/img/services1.png') }}" alt="" style="width: 100px; height: 100px;" srcset="">
                            </div>
                            <h5 class="mt-4 mb-3">Growth Marketing</h5>
                            <p class="mb-0">
                                "Mendukung pertumbuhan bisnis dengan strategi pemasaran yang berfokus
                                pada keberlanjutan dan tanggung jawab sosial, untuk memberikan dampak
                                positif bagi pelajar dan masa depan."
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                                <img src="{{ asset('panel/img/services2.png') }}" alt="" style="width: 100px; height: 100px;" srcset="">
                            
                            </div>
                            <h5 class="mt-4 mb-3">Online Brending</h5>
                            <p class="mb-0">
                                "Memperkuat citra perusahaan di dunia digital dengan menonjolkan
                                komitmen terhadap tanggung jawab sosial perusahaan (CSR), menciptakan
                                kesadaran merek yang peduli dan berdampak."
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                                <img src="{{ asset('panel/img/services3.jpg') }}" alt="" style="width: 100px; height: 100px;" srcset="">
                            </div>
                            <h5 class="mt-4 mb-3">Social Impact Innovation</h5>
                            <p class="mb-0">
                                "Memanfaatkan inovasi teknologi untuk menciptakan perubahan sosial yang nyata,
                                melalui program CSR yang mendukung inklusi, pendidikan,sarana,dan pra-sarana."
                            </p>
                                
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Service Start -->


        <!-- Join us Start -->
        <div class="container-fluid py-5" id="join-us">
            <div class="container py-5 px-lg-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <img class="img-fluid wow fadeInUp" data-wow-delay="0.1s" src="{{ asset('panel/img/Chlorine Digital Media.png') }}">
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                        <h5 class="text-primary-gradient fw-medium">Join us</h5>
                        <h1 class="mb-4">LET'S JOIN US!!!</h1>
                        <p class="mb-4">
                            Kenapa harus bergabung dengan kami?
                        </p>
                        <div class="row g-4">
                            <ul>
                                <li>Perusahaan dapat menemukan kemudahan dalam monitoring</li>
                                <li>Memastikan akuntabilitas dalam pelaksanaan program CSR</li>
                                <li>Memastikan transparansi dalam pelaksanaan program CSR</li>
                                <li>Memastikan evektifitas dalam pelaksanaan program CSR</li>
                                <li>Menyediakan sarana monitoring yang mudah,aman,dan dapat
                                   di akses di manapun</li>
                              </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Join us End -->


        <!-- the-founder Start -->
        <div class="container-fluid py-5" id="the-founder">
            <div class="container py-5 px-lg-5">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">THE FOUNDER AND DIRECTURE</h1>
                </div>

                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="tab-content text-start">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row gy-5 gx-4 justify-content-center">
                                <div class="col-md-5 founder">
                                    <p>
                                      Hardyansyah dikenal sebagai pendiri dan juga CEO dari perusahaan
                                      bernama CHLORINE, selain itu diapun sebagai Asesor BNSP RI,
                                      Intruktur Lembaga Kursus & Pelatihan Kerja, Mentor Bisnis yang
                                      sudah tersertifikasi dari BNSP.
                                    </p>
                                    <img src="{{ asset('panel/img/BAPAK.jpg') }}" />
                                    <p class="user-details">
                                      <b>Hardyansyah</b><br />
                                      Ceo and Founder chlorine digital media
                                    </p>
                                  </div>
                                  <div class="col-md-5 founder">
                                    <p>
                                      Adam Setia Nungraha adalah seorang kreatif yang terlibat dalam
                                      beberapa kolaborasi penting di PT Chlorine Digital Media. Di sana,
                                      ia berperan sebagai sutradara dalam proyek film Orang Dalam,
                                      sebuah film hasil kerja sama PT Chlorine dengan SMKN 14 Bandung.
                                    </p>
                                    <img src="{{ asset('panel/img/BAPAK2.jpg') }}" />
                                    <p class="user-details">
                                      <b>Adam Setia Nugraha</b><br />
                                      Creative Directur
                                    </p>
                                  </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- the-founder End -->


        

        <!-- Footer Start -->
        <div class="container-fluid bg-primary text-light footer wow fadeIn" data-wow-delay="0.1s" id="contact">
            <div class="container py-5 px-lg-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6">
                        <h4 class="text-white mb-4">The Priority</h4>
                        <p>
                            Web aplikasi yang bertujuan untuk memantau
                            dan mengelola program Corporate Social Responsibility (CSR)
                          </p>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <h4 class="text-white mb-4">Hubungi kami</h4>
                        <p>
                            <i class="fa fa-map-marker"></i> Jl. Kebon Sirih No. 40, Babakan
                            Ciamis,   Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40117
                          </p>
                          <p><i class="fa fa-phone"></i> +6282140405444</p>
                          <p>
                            <i class="fa fa-envelope-o"></i> info@chlorinedigitalmedia.com
                          </p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>

            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Tefa Solution</a>, All Right Reserved. 
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-lg-square back-to-top pt-2"><i class="bi bi-arrow-up text-white"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('panel/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('panel/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('panel/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('panel/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('panel/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('panel/js/main.js') }}"></script>
</body>

</html>