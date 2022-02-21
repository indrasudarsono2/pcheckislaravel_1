<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
    .loader{
      width: 35px;
      position: absolute;
      top:198px;
      left:330px;
      display: none;
    }
    .loader_findFiles{
      width: 35px;
      position: absolute;
      top:142px;
      left:330px;
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
          <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{ url('password_') }}" class="dropdown-item has-icon">
                <i class="fas fa-bolt" style="color: grey"></i> Password
              </a>
              
              <div class="dropdown-divider"></div>
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
            <a href="{{url ('super') }}"  style="color:white;">Performance Check</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header"><span>Dashboard</span></li>
            <li class="nav-item dropdown">
              <a href="{{url ('super') }}"><i class="fas fa-columns"></i><span>Dashboard</span></a>
            </li>
        
            <li class="menu-header"><span>Manage Participants</span></li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Participants</span></a>
              <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ url('/users') }}">Show Participants</a></li>
              <li><a class="nav-link" href="{{ url('/users/create')}}">Add Participant</a></li>
              </ul>
            </li>

            @if (auth()->user()->remark_id==1)
            <li class="menu-header"><span>Preparing Check</span></li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-business-time"></i><span>Preparation</span></a>
              <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ url('/sessions')}}">Manage Session</a></li>
              <li><a class="nav-link" href="{{ url('/groupss') }}">Defining Group</a></li>
              <li><a class="nav-link" href="{{ url('session_gain') }}">Getting Rating</a></li>
              <li><a class="nav-link" href="{{ route('schedules.index') }}">PC Schedule</a></li>
              <li><a class="nav-link" href="{{ route('provisions.index') }}">Debriefing</a></li>
              </ul>
            </li>
            @endif   
                   
            @if (auth()->user()->remark_id==1)
            <li class="menu-header"><span>Manage Questions</span></li>
            <li class="nav-item dropdown">
              <a href="{{ route('aplication_ratings.index') }}" class="nav-link"><i class="fas fa-star"></i><span>Multiple Choice</span></a>
            </li>
            <li class="nav-item dropdown">
            {{-- <a href="{{ route('essays.index') }}" class="nav-link"><i class="fas fa-pen"></i><span>Essay</span></a> --}}
            <a href="{{ route('aplication_ratings.create') }}" class="nav-link"><i class="fas fa-pen"></i><span>Essay</span></a>
            </li>   
            <li class="nav-item dropdown">
            <a href="{{ route('ar_pc.index') }}" class="nav-link"><i class="fas fa-plane"></i><span>Performance Check</span></a>
            </li>   
            @endif

            <li class="menu-header"><span>Monitor Perf. Check</span></li>
            <li class="nav-item dropdown">
              <a href="{{ url('/session_monitor') }}"><i class="fas fa-medal"></i><span>Monitor & Practical</span></a>
            </li>

            <li class="menu-header"><span>Performance Check's Scores</span></li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-graduate"></i><span>Scores</span></a>
              <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('score_sessions') }}">Session</a></li>
              <li><a class="nav-link" href="{{ route('user_scores') }}">Participant</a></li>
              </ul>
            </li>
            
            @if (auth()->user()->remark_id==1)
            <li class="menu-header"><span>Statistic</span></li>
            <li class="nav-item dropdown">
              <a href="{{ url('/session_statistic') }}"><i class="fas fa-chart-area"></i><span>Statistic</span></a>
            </li>
            @endif

            <li class="menu-header"><span>Data</span></li>
            <li class="nav-item dropdown">
              <a href="{{ url('/ielp_super') }}"><i class="fas fa-microphone-alt"></i><span>IELP</span></a>
              <a href="{{ url('/medex_super') }}"><i class="fas fa-file-medical"></i><span>Medex</span></a>
            </li>
        
            <li class="menu-header"><span>History</span></li>
            <li class="nav-item dropdown">
              <a href="{{ url('/sessions_history') }}"><i class="fas fa-history"></i><span>Session</span></a>
            </li>
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
  {{-- <script src="{{ asset('stisla/assets/js/popper.min.js.map') }}" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> --}}
  <script src="{{ asset('stisla/assets/js/bootstrap-4.3.1.min.js') }}" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="{{ asset('stisla/assets/js/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('stisla/assets/js/moment.min.js') }}"></script>
  <script src="{{ asset('stisla/assets/js/stisla.js') }}"></script>

  {{-- <!-- JS Libraies -->
  <script src="../node_modules/simpleweather/jquery.simpleWeather.min.js"></script>
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