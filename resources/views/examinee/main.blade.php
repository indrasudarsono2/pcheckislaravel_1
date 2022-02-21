<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title')</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('Login/images/logo2.png') }}" />

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('stisla/assets/css/bootstrap.min.css') }}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('stisla/fontawesome/css/all.css') }}" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  {{-- <!-- CSS Libraries -->
  <link rel="stylesheet" href="../node_modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="../node_modules/weathericons/css/weather-icons.min.css">
  <link rel="stylesheet" href="../node_modules/weathericons/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="../node_modules/summernote/dist/summernote-bs4.css"> --}}

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('stisla/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/assets/css/components.css') }}">
  <style>
		table {
			border-collapse: collapse;
		}

		table,
		th,
		td
    {
			border: 1px solid black;
		}

		th, td {
            padding: 5px;
        }

		.kemenhub{
			width: 80px;
		  top:198px;
      left:10px;
		}

		.lurus{
				text-indent: 18px;
			}

      #mc_question fieldset:not(:first-of-type) {
       display: none;
     }

     span, i{
       color: white;
     }
     
        
	</style>
 
</head>

<body class="sidebar-mini">
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
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user" style="text-transform:uppercase">
          <div class="d-sm-none d-lg-inline-block" style="color: white">Hi, {{ Auth::user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{ url('profil') }}" class="dropdown-item has-icon">
                <i class="far fa-user" style="color: grey"></i> Profile
              </a>
              <a href="{{ url('password_usr') }}" class="dropdown-item has-icon">
                <i class="fas fa-bolt" style="color: grey"></i> Password
              </a>
              
              <div class="dropdown-divider text-grey-200"></div>
               <a href="{{route ('logout')}}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt" style="color: grey"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{url ('examinee')}}" style="color:white;">Proficiency Check</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header"><span>Dashboard</span></li>
            <li class="nav-item dropdown">
              <a href="{{url ('examinee')}}"><i class="fas fa-columns"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-header"><span>Completeness Files</span></li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-alt"></i><span>Files</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ url('licensess') }}">License</a></li>
                <li><a class="nav-link" href="{{ url('logbookss') }}">Log Book</a></li>
                <li><a class="nav-link" href="{{ url('med') }}">Medex</a></li>
                <li><a class="nav-link" href="{{ url('ielpp') }}">IELP</a></li>
                <li><a class="nav-link" href="{{ url('formal_educations') }}">Formal Education</a></li>
                <li><a class="nav-link" href="{{ url('competence_sertificates') }}">Competence Sertificate</a></li>
              </ul>
            </li>
        
            <li class="menu-header"><span>Application Files</span></li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-layer-group"></i><span>Application Files</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ url('af') }}">Application Files</a></li>
              </ul>
            </li>

            <li class="menu-header"><span>Performance Check</span></li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-signature"></i><span>Examination</span></a>
              <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('files') }}">Check</a></li>
              </ul>
            </li>
        
            <li class="menu-header"><span>Score History</span></li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-history"></i><span>Score's Files</span></a>
              <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('scoress.index') }}">Performance Check</a></li>
              <li><a class="nav-link" href="{{ route('practical_exams.index') }}">Practical Exam</a></li>
              </ul>
            </li>

            @if (auth()->user()->remark_id==4)
            <li class="menu-header"><span>Checker Menu</span></li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fab fa-elementor"></i><span>Menu</span></a>
              <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('sessionss.index') }}">Verification</a></li>
              <li><a class="nav-link" href="{{ route('session_practice') }}">Performance Check</a></li>
              <li><a class="nav-link" href="{{ route('session_getingRating') }}">Getting Rating</a></li>
              </ul>
            </li>
            @endif
          </ul>   
      </div>        
              

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            @yield('section-header')
          </div>
          <div class="section-body">
            <h2 class="section-title">
              @yield('section-title')
            </h2>
            @yield('contain')
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright <?php echo date('Y'); ?> &copy; JATSC ATS SYSTEM 
        </div>
        <div class="footer-right">
        Version 1.1.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('stisla/assets/js/jquery.form.js') }}"></script>
  <script src="{{ asset('stisla/assets/js/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('stisla/assets/js/additional-method.min.js') }}"></script>

  {{-- <script src="{{ asset('stisla/assets/js/popper.min.js.map') }}" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> --}}
  <script src="{{ asset('stisla/assets/js/bootstrap-4.3.1.min.js') }}" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="{{ asset('stisla/assets/js/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('stisla/assets/js/moment.min.js') }}"></script>
  <script src="{{ asset('stisla/assets/js/stisla.js') }}"></script>
  

  <!-- JS Libraies -->
  {{-- <script src="../node_modules/simpleweather/jquery.simpleWeather.min.js"></script>
  <script src="../node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="../node_modules/jqvmap/dist/jquery.vmap.min.js"></script>
  <script src="../node_modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="../node_modules/summernote/dist/summernote-bs4.js"></script>
  <script src="../node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script> --}}

 <!-- Template JS File -->
 <script src="{{ asset('stisla/assets/js/scripts.js') }}"></script>
 <script src="{{ asset('stisla/assets/js/custom.js') }}"></script>

 <!-- Page Specific JS File -->
 {{-- <script src="{{ asset('stisla/assets/js/page/index-0.js') }}"></script> --}}
</body>
</html>