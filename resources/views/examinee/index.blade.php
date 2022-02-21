@extends('examinee/main')

@section('title', 'Dashboard Examinee')

@section('section-header')
<h1>Dashboard</h1>
@endsection

@section('section-title')
Announcement    
@endsection

@section('contain')
@if (session('alert'))
  <div class="alert alert-danger alert-dismissible show fade">
    <div class="alert-body">
      <button class="close" data-dismiss="success">
        <span>×</span>
      </button>
      {{ session('alert') }}
    </div>
  </div>
@endif
<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1" style="background-color: #3736f7; border-radius: 10px;">
      <div class="card-icon">
        <i class="fas fa-headset" style="font-size: 45px; position: absolute;top:28px;left:28px; color:white;display:" id="ilp"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h3 style="color:white;font-size:18px;">IELP</h3>
        </div>
        <div class="card-body" id="ielp">
          
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1" style="background-color: #f73636; border-radius: 10px;">
      <div class="card-icon">
        <i class="fas fa-file-medical-alt" style="font-size: 45px; position: absolute;top:28px;left:28px;display;" id="med"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h3 style="color:white;font-size:18px;">MEDEX</h3>
        </div>
        <div class="card-body" id="medex">
          
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1" style="background-color: #f7ae36; border-radius: 10px;">
      <div class="card-icon">
        <i class="fas fa-ban" style="font-size: 45px; color:white; position: absolute;top:28px;left:27px;display:" id="end"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header" id="title">
          
        </div>
        <div class="card-body" id="schedule">
          
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1" style="background-color: #06db8c; border-radius: 10px;">
        <div class="card-icon">
          <i class="fas fa-users" style="font-size: 45px; position: absolute;top:28px;left:22px"></i>
        </div>
        <div id="container">
        @if ($aplication_file==null)
        <div class="card-wrap">
          <div class="card-header">
            <h3 style="color: white;font-size:18px;">Debriefing</h3>
          </div>
          <div class="card-body" id="provison">
            <h4 style="color: white">No application file available</h4>
          </div>
        </div>
        @else
        <div class="card-wrap">
          <div class="card-header">
            <h4 style="color:white;font-size:18px;">Debriefing {{ $aplication_file->number }}</h4>
          </div>
          <div class="card-body" id="provison">
            <div class="row">
              <div class="col-lg-12">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Token" name="token" id="provision_input">
                  <button href="#" class="btn btn-info fas fa-cogs" type="button" id="btn_provision"></button>
                </div>
              </div>
            </div>
          </div>
        </div>  
        @endif
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('stisla/assets/js/jquery.countdown.js') }}"></script>
<script type="text/javascript">

  $("#ielp")
  .countdown("<?php echo $ielp->expired; ?>", function(event) {
    if(event.offset.months < 1){
      $(this).html(
        event.strftime('<span style="color:black;">! %D days %H:%M:%S</span>')
      );
      var i = document.getElementById('ilp');
      setInterval(() => {
        i.style.display = (i.style.display == 'none' ? '' : 'none');
      }, 3000);
    }else if(event.offset.months <= 2){
      $(this).html(
        event.strftime('<span style="color:black;">! %D days %H:%M:%S</span>')
      );
    }else{
      $(this).html(
        event.strftime('<span style="color:white;">%D days %H:%M:%S</span>')
      );
    }
  });

  $("#medex")
  .countdown("<?php echo $medex->expired; ?>", function(event) {
    if(event.offset.months < 1){
      $(this).html(
        event.strftime('<span style="color:black;">! %D days %H:%M:%S</span>')
      );
      var m = document.getElementById('med');
      setInterval(() => {
        m.style.display = (m.style.display == 'none' ? '' : 'none');
      }, 2000);
    }else if(event.offset.months <= 2){
      $(this).html(
        event.strftime('<span style="color:black;">! %D days %H:%M:%S</span>')
      );
    }else{
      $(this).html(
        event.strftime('<span style="color:white;">%D days %H:%M:%S</span>')
      );
    }
  });

  let date = new Date();
  let hari = date.getDate();
  let start = "<?php echo $schedule->schedule_start; ?>"
  let start_for = new Date(start);
  if(date<start_for){
    $("#schedule").countdown(start, function(event) {
      $(this).html(event.strftime('<span style="color:white;">%D days %H:%M:%S</span>'));
    });
    $("#title").html("<h3 style='color:white;font-size:18px;'>Starts in</h3>");
  }else{
      $("#schedule").countdown("<?php echo $schedule->schedule_for_finish ?>", function(event) {
        $(this).html(event.strftime("<span style='color:white;'>%D days %H:%M:%S</span>"));
      });
      $("#title").html("<h3 style='color:white;font-size:18px;display:'>Examination ends in</h3>");
      var f = document.getElementById('end');
      setInterval(() => {
        f.style.display = (f.style.display == 'none' ? '' : 'none');
      }, 1000);
  }
</script>
<script src="{{ asset('js/provision.js') }}"></script>
@endsection
    
