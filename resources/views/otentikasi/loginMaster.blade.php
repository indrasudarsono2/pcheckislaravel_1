<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; proton.iatca-jakarta.or.id</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('icon-airnav.png') }}" />
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('stisla/assets/css/bootstrap.min.css') }}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('stisla/fontawesome/css/all.css') }}" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('stisla/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/assets/css/components.css') }}">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
          <div class="p-4 m-3">
          <img src="{{ asset('iatca3.png') }}" alt="logo" width="150">
            <h4 class="text-dark font-weight-normal mt-3">Welcome to <span class="font-weight-bold">PROTON</span></h4>
            <h6 class="text-dark font-weight-normal"><span class="font-weight-bold">PROFICIENCY CHECK FOR ATC RATINGS - ONLINE</span></h6>
            <p class="text-muted">Before you get started, you must login.</p>
            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
              @csrf
              <div class="form-group">
                <label for="email">License Number</label>
                <input id="email" type="text" class="form-control" name="license_number" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                  Please fill in your license number
                </div>
              </div>

              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">Password</label>
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                <div class="invalid-feedback">
                  please fill in your password
                </div>
              </div>

              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                  <label class="custom-control-label" for="remember-me">Remember Me</label>
                </div>
              </div>

              @if (session('alert'))
                <div class="alert alert-danger alert-dismissible show fade">
                  <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>×</span>
                    </button>
                    Email does not exists !
                  </div>
                </div>
              @endif
              @if (session('message'))
                <div class="alert alert-danger alert-dismissible show fade">
                  <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>×</span>
                    </button>
                    Wrong license number or password
                  </div>
                </div>
              @endif
              @if (session('status'))
                <div class="alert alert-success alert-dismissible show fade">
                  <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>×</span>
                    </button>
                    Password edited successfully
                  </div>
                </div>
              @endif
              @if (session('msg'))
              <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                  <button class="close" data-dismiss="success">
                    <span>×</span>
                  </button>
                  {{ session('msg') }}
                </div>
              </div>
              @endif
              @if (session('warning'))
              <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                  <button class="close" data-dismiss="success">
                    <span>×</span>
                  </button>
                  {{ session('warning') }}
                </div>
              </div>
              @endif
              
              <div class="form-group text-right">
                <a href="{{ url('/forgot_password') }}" class="float-left mt-3">
                  Forgot Password?
                </a>
                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                  Login
                </button>
              </div>
         
            </form>

            <div class="text-center mt-5 text-small">
              Copyright <?php echo date('Y'); ?> &copy; JATSC ATS SYSTEM
              <div class="mt-2">
               
              </div>
            </div>
          </div>
        </div>
      <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="{{ asset('stisla/assets/img/unsplash/jatsc.jpg') }}">
          <div class="absolute-bottom-left index-2">
            <div class="text-light p-5 pb-2">
              <div class="mb-5 pb-3">
                <h1 class="mb-2 display-4 font-weight-bold">Hello</h1>
              </div>
              Photo by <a class="text-light bb" target="_blank" href="https://airnavindonesia.co.id">Airnav Indonesia</a> on <a class="text-light bb" target="_blank" href="https://twitter.com">Twitter</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset ('stisla/assets/js/jquery-3.3.1.min.js') }}" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> --}}
  <script src="{{ asset ('stisla/assets/css/bootstrap.min.js') }}" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="{{ asset ('stisla/assets/js/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset ('stisla/assets/css/moment.min.js') }}"></script>
  <script src="{{ asset ('stisla/assets/js/stisla.js') }}"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="{{ asset ('stisla/assets/js/scripts.js') }}"></script>
  <script src="{{ asset ('stisla/assets/js/custom.js') }}"></script>

  <!-- Page Specific JS File -->
</body>
</html>
