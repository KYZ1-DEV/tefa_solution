<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login Web</title>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="{{ asset('auth/style.css') }}" />
  </head>
  <body class="img js-fullheight" style="background-image: url({{ asset('auth/bg2.jpg') }});overflow: hidden;">
    <section class="ftco-section" style="margin-top: -50px !important;">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 text-center mb-1">
            <h2 class="heading-section">SIGN IN</h2>
          </div>
        </div>
 

        <div class="row justify-content-center">

          <div class="col-md-6 col-lg-4">
           
            <div class="login-wrap p-0">
              <h3 class="mb-4 text-center">Have an account?</h3>
              <a href="/" style="padding-bottom: 14px; color:rgb(211, 161, 241);">&laquo; Kembali</a>
                  @if (Session::get('success'))
                  <div class="alert alert-success alert-dismissible fade show" style="opacity: 60%; height: 50px;" >
                    <li>{{ Session::get('success') }}</li>
                  </div>
                  @endif

                  @if (Session::get('error'))
                  <li class="text-center" style="color: red;">{{ Session::get('error') }}</li>
              @endif
              <form action="{{ route('auth') }}" novalidate method="POST" class="signin-form" autocomplete="off">
                @csrf
                <div class="form-group">
                  <input
                  type="email"
                  name="email"
                  class="form-control  @error('email') is-invalid @enderror"
                  placeholder="Email"
                  value="{{ old('email') }}"
                  required
                />
                @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <input
                    id="password-field"
                    type="password"
                    name="password"
                  class="form-control  @error('password') is-invalid @enderror"
                    placeholder="Password"
                    required
                  />
                 
                  <span style="@error('password') margin-top: -14px; @enderror" 
                    toggle="#password-field"
                    class="fa fa-fw fa-eye field-icon toggle-password"
                  ></span>
                  @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <button
                    type="submit"
                    style="background-color: rgb(163, 62, 225)"
                    class="form-control btn submit px-3"
                  >
                    Sign In
                  </button>
                </div>
                <div class="form-group d-md-flex">
                  <div class="w-50">
                    <label class="checkbox-wrap" 
                    style="color: rgb(187, 129, 224);"
                      
                    >Remember Me
                      <input type="checkbox" />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="w-50 text-md-right">
                    <a href="#" style="color: #fff">Forgot Password</a>
                  </div>
                </div>
              </form>
              <p class="w-100 text-center">&mdash; Sign Up &mdash;</p>
              <div class="text-center">
                Not a Member ?
                <a
            href="{{ route('registrasi') }}"
            style="color: rgb(187, 129, 224);"
              class="w-100"
            >Sign Up</a
            >
            </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="{{ asset('auth/js/jquery.min.js') }}"></script>
    <script src="{{ asset('auth/js/popper.js') }}"></script>
    <script src="{{ asset('auth/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('auth/js/main.js') }}"></script>
    <script
      defer
      src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
      integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
      data-cf-beacon='{"rayId":"8c4d64bec8b3ce11","serverTiming":{"name":{"cfExtPri":true,"cfL4":true}},"version":"2024.8.0","token":"cd0b4b3a733644fc843ef0b185f98241"}'
      crossorigin="anonymous"
    ></script>
  </body>
</html>
