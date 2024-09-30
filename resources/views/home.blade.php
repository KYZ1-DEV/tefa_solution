<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>CSR Website</title>
    <link rel="stylesheet" href="{{ asset('panel/style.css') }}" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    
  </head>
  <body>
    <section id="nav-bar">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">Chlorine Agency</a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link"  href="#banner">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#services">SERVICES</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about-us">JOIN US</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#testimonials">THE FOUNDER</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#footer">CONTACT</a>
            </li>
          </ul>
        </div>
      </nav>
    </section>

    <!-- Bannner -->
    <section id="banner" >

      <div class="container">
        <div class="row">
        
          <div class="col-md-6" style="margin-top: -50px !important">
            <p class="promo-title">Monitoring CSR</p>
            <p>
              Aplikasi Web Monitoring CSR ini buat dan dikembangkan oleh tim tefa solution
              bersama PT Chlorine, sebagai alat untuk memantau dan mengelola program
              Corporate Social Responsibility (CSR). Aplikasi ini dirancang untuk
              memastikan transparansi, efektivitas, dan akuntabilitas dalam pelaksanaan 
              program CSR, khususnya bantuan yang diberikan kepada sekolah-sekolah yang
             bekerja sama dalam proyek ini.
            </p>
            <a href="{{ route('login') }}" class="btn-3d m-2">Sign In</a>
                    
            <a href="{{ route('register.show') }}" class="btn-3d m-2">Sign Up</a>
          </div>
          <div class="col-md-6">
            @if (Session::get('success'))
                  <div class="alert alert-success alert-dismissible fade show" style="opacity: 40%; height: 50px !important;" >
                    <ul style="padding-left: 20px">
                        <li >{{ Session::get('success') }}</li>
                    </ul>
                </div>
            @endif
             
            <img src="{{ asset('panel/img/Chlorine Digital Media.png') }}" class="img-fluid responsive-image" height="400" width="400" style="float: right; margin-left: 5px; margin-top: 10px;">
        </div>
        
        </div>
      </div>
      <img src="{{ asset('panel/img/wave.png') }}" class="bottom-img" />
    </section>
    <!-- Akhir Banner -->

    <!-- Services -->
    <section id="services">
      <div class="container text-center">
        <h1 class="title">Services!</h1>
        <div class="row text-center">
          <div class="col-md-4 services">
            <img src="{{ asset('panel/img/services1.png') }}" class="services-img" />
            <h4>Growth Marketing</h4>
            <p>
              "Mendukung pertumbuhan bisnis dengan strategi pemasaran yang berfokus
               pada keberlanjutan dan tanggung jawab sosial, untuk memberikan dampak
               positif bagi pelajar dan masa depan."
            </p>
          </div>
          <div class="col-md-4 services">
            <img src="{{ asset('panel/img/services2.png') }}" class="services-img" />
            <h4>Online Brending</h4>
            <p>
              "Memperkuat citra perusahaan di dunia digital dengan menonjolkan
               komitmen terhadap tanggung jawab sosial perusahaan (CSR), menciptakan
               kesadaran merek yang peduli dan berdampak."
            </p>
          </div>
          <div class="col-md-4 services">
            <img src="{{ asset('panel/img/services3.jpg') }}" class="services-img" />
            <h4>Social Impact Innovation</h4>
            <p>             
"Memanfaatkan inovasi teknologi untuk menciptakan perubahan sosial yang nyata,
 melalui program CSR yang mendukung inklusi, pendidikan,sarana,dan pra-sarana."
            </p>
          </div>
        </div>
        <button type="button" class="btn btn-primary">All Services</button>
      </div>
    </section>
    <!-- Akhir Services -->

    <!-- About Us -->
    <section id="about-us">
      <div class="container">
        <h1 class="title text-center">LET'S JOIN US!!!</h1>
        <div class="row">
          <div class="col-md-6 about-us">
            <p class="about-title">Kenapa harus bergabung dengan kami?</p>
            <ul>
              <li>Perusahaan dapat menemukan kemudahan dalam monitoring</li>
              <li>Memastikan akuntabilitas dalam pelaksanaan program CSR</li>
              <li>Memastikan transparansi dalam pelaksanaan program CSR</li>
              <li>Memastikan evektifitas dalam pelaksanaan program CSR</li>
              <li>Menyediakan sarana monitoring yang mudah,aman,dan dapat
                 di akses di manapun</li>
            
            </ul>
          </div>
          <div class="col-md-6 d-flex justify-content-end">
            <img src="{{ asset('panel/img/Chlorine Digital Media.png') }}" class="img-fluid responsive-image" style="margin-top: -40px;">
        </div>
        
        
        
        </div>
      </div>
    </section>
    <!-- Akhir About Us -->

    <!-- Testimonials -->
    <section id="testimonials">
      <div class="container">
        <h1 class="title text-center">THE FOUNDER AND DIRECTUR</h1>
        <div class="row offset-1">
          <div class="col-md-5 testimonials">
            <p>
              Hardyansyah dikenal sebagai pendiri dan juga CEO dari perusahaan
              bernama CHLORINE, selain itu diapun sebagai Asesor BNSP RI,
              Intruktur Lembaga Kursus & Pelatihan Kerja, Mentor Bisnis yang
              sudah tersertifikasi dari BNSP.
            </p>
            <img src="{{ asset('panel/img/BAPAK.jpg') }}" />
            <p class="user-details">
              <b>Hardyansyah</b><br />
              Ceo and Founder chlorinedigitalmedia
            </p>
          </div>
          <div class="col-md-5 testimonials">
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
    </section>
    <!-- Akhir Testimonisal -->

    <!-- Social Media Section -->
    <section id="social-media">
      <div class="container text-center">
        <p>CARI KAMI DI SOSIAL MEDIA!</p>
      </div>
      <div class="social-icon text-center">
        <a href="#"><img src="{{ asset('panel/img/facebook-icon.png') }}" /></a>
        <a href="#"><img src="{{ asset('panel/img/instagram-icon.png') }}" /></a>
        <a href="#"><img src="{{ asset('panel/img/twitter-icon.png') }}" /></a>
        <a href="#"><img src="{{ asset('panel/img/whatsapp-icon.png') }}" /></a>
        <a href="#"><img src="{{ asset('panel/img/linkedin-icon.png') }}" /></a>
        <a href="#"><img src="{{ asset('panel/img/snapchat-icon.png') }}" /></a>
      </div>
    </section>
    <!-- Akhir Social Media Section -->

    <!-- Footer -->
    <section id="footer">
      <img src="{{ asset('panel/img/wave2.png') }}" class="footer-img" />
      <div class="container">
        <div class="row">
          <div class="col-md-4 footer-box">
            <h3 class="title-footer">The priority</h3>
            <p>
              web aplikasi yang bertujuan untuk memantau
              dan mengelola program Corporate Social Responsibility (CSR)
            </p>
          </div>
          <div class="col-md-4 footer-box">
            <h3 class="title-footer">Hubungi kami</h3>
            <p>
              <i class="fa fa-map-marker"></i> Jl. Kebon Sirih No. 40, Babakan
              Ciamis,   Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40117
            </p>
            <p><i class="fa fa-phone"></i> +6282140405444</p>
            <p>
              <i class="fa fa-envelope-o"></i> info@chlorinedigitalmedia.com
            </p>
          </div>
          <div class="col-md-4 footer-box">
            <h3 class="title-footer">Pengaduan</h3>
            <input type="text" class="form-control" placeholder="Your Name" />
            <input type="email" class="form-control" placeholder="Your Email" />
            <textarea type="text" class="form-control" placeholder="..."></textarea>
            <button type="button" class="btn btn-primary">Kirim</button>
          </div>
        </div>
        <hr />
        <p class="copyright">Create By Tefa Solution</p>
      </div>
    </section>
    <!-- Akhir Footer -->

    <!-- Smooth Scrooll -->
    <script src="{{ asset('panel/smooth-scroll.js') }}"></script>
    <script>
      var scroll = new SmoothScroll('a[href*="#"]');
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </body>
</html>
