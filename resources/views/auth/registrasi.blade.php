<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Daftar Web</title>
    <link rel="short icon" href="{{ asset('logoC.png') }}">
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
    <section class="ftco-section" style="margin-top: -70px !important; ">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 text-center mb-1">
            <h2 class="heading-section">SIGN UP</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-4">
            <div class="login-wrap p-0">
              <h3 class="mb-2 text-center">Create new account</h3>
                @error('password')
                <li class="text-center" style="color: red;">{{ $message}}</li>
                @enderror
              <form action="{{ route('auth.register') }}"  method="POST" novalidate autocomplete="off" class="signin-form">
                @csrf
                <div class="form-group">
                  <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Name"
                    value="{{ old('name') }}"
                    required
                  />
                  @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
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
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password"
                    required
                  />
                  <span
                    toggle="#password-field"
                    class="fa fa-fw fa-eye-slash field-icon toggle-password"
                  ></span>
                </div>
                <div class="form-group">

                    <input
                      id="password-confirm-field"
                      type="password"
                      name="password_confirmation"
                      class="form-control @error('password') is-invalid @enderror"
                      placeholder="Confirm Password"
                      required
                    />
                    <span toggle="#password-confirm-field" class="fa fa-fw fa-eye-slash field-icon toggle-password1" style="top:58%!important;"></span>
                  </div>
                <div class="form-group">
                  <label for="role"> Select Role</label>
                  <select class="form-control @error('role') is-invalid @enderror" name="role" id="role">

                    <option value="" style="color: black">
                      Pilih Role
                    </option>
                    <option value="sekolah" style="color: black">
                      Sekolah
                    </option>
                    <option value="industri" style="color: black">
                      Industri
                    </option>
                  </select>
                  @error('role')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror

                </div>


                <div class="form-group">
                  <button
                    type="submit"
                    style="background-color: rgb(163, 62, 225);"
                    class="form-control btn submit"
                    >
                    Sign up
                  </button>
                </div>
                <div class="form-group d-md-flex"></div>
              </form>
                <div class="text-center" style="margin-top: -10px !important;">
                    Have a account?
                    <a
                href="{{ route('login') }}"
                class="w-100"
                style="color: rgb(187, 129, 224);"

                >Sign in</a
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
