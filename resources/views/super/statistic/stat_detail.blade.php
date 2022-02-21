@extends('super/main')

@section('title', 'Statistic')

@section('section-header')
<h1>Statistic</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ url('/session_statistic') }}">Statistic</a></div>
  <div class="breadcrumb-item active"><a href="{{ route('sessions.aplication_ratings.index_statistic', [$session,$aplication_rating]) }}">Rating</a></div>
  <div class="breadcrumb-item active"><a href="{{ route('sessions.aplication_ratings.show', [$session,$aplication_rating]) }}">Statistic</a></div>
</div> 
@endsection

@section('section-title')
Session {{ $session->year }}-{{ $session->period }} Rating {{ $aplication_rating->rating->rating }}  
@endsection

@section('contain')

<div class="card">
  <div class="table-responsive">
    <table style="border: 0px">
      <tr>
        <td width="40px" valign="top" style="border: 0px"><font size="5px">{{ $statistic->id }}.</font></td>
        <td width="1250px" style="border: 0px"><font size="5px">{{ $statistic->question }}</font></td>
      </tr>
      <tr>
        <td width="40px" valign="top" style="border: 0px"></td>
        <td width="1250px" style="border: 0px">
          <div class="form-check form-check-inline">
            <label class="form-check-label" for="1" @if($statistic->key=="A") style="color: rgb(99, 204, 0)" @endif>
              <font size="5px">A. {{ $statistic->a }}</font>
            </label>
          </div>
        </td>
      </tr>
      <tr>
        <td width="40px" valign="top" style="border: 0px"></td>
        <td width="1250px" style="border: 0px">
          <div class="form-check form-check-inline">
            <label class="form-check-label" for="1" @if($statistic->key=="B") style="color: rgb(99, 204, 0)" @endif>
              <font size="5px">B. {{ $statistic->b }}</font>  
            </label>
          </div>
        </td>
      </tr>
      <tr>
        <td width="40px" valign="top" style="border: 0px"></td>
        <td width="1250px" style="border: 0px">
          <div class="form-check form-check-inline">
            <label class="form-check-label" for="1" @if($statistic->key=="C") style="color: rgb(99, 204, 0)" @endif>
              <font size="5px">C. {{ $statistic->c }}</font>
            </label>
          </div>
        </td>
      </tr>
      <tr>
        <td width="40px" valign="top" style="border: 0px"></td>
        <td width="1250px" style="border: 0px">
          <div class="form-check form-check-inline">
            <label class="form-check-label" for="1" @if($statistic->key=="D") style="color: rgb(99, 204, 0)" @endif>
              <font size="5px">D. {{ $statistic->d }}</font> 
            </label>
          </div>
        </td>
      </tr>
    </table>
    <div class="row">
      <div class="col-lg-6">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <td width="10px" align="center" scope="col"><b>Selected Answer</b></td>
              <td width="50px" align="center" scope="col"><b>Amount</b></td>
              <td width="50px" align="center" scope="col"><b>Persentage</b></td>
            </tr>
          </thead>
          <tbody>
            @foreach ($stat_detail as $stat_detail)
            <tr>
              <td align="center">{{ $stat_detail->answer }}</td>
              <td align="center">{{ $stat_detail->selected_answer}}</td>
              <td align="center">{{ $stat_detail->persentage }}%</td>
            </tr>
            <?php
              $option[] = $stat_detail->answer;
              $amount[] = $stat_detail->selected_answer;
            ?>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="col-lg-6">
        <canvas id="statistic" width="100%" height="45">disini</canvas>
        
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/chart.min.js') }}"></script>
<script>
  var ctx = document.getElementById("statistic").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: <?php echo json_encode($option); ?>,
      datasets: [{
        label: 'Answer',
        data: <?php echo json_encode($amount); ?>,
        backgroundColor:[
          "rgba(203, 222, 225, 0.9)",
          "rgba(102, 50, 179, 1)",
          "rgba(201, 29, 29, 1)",
          "rgba(81, 230, 153, 1)",
          "rgba(66, 34, 19, 1)"
        ],
        
      }]
    },
    options:{
              responsive: true
    	      }
    // options: {
    //   scales: {
    //     yAxes: [{
    //       ticks: {
    //         beginAtZero: true
    //       }
    //     }]
    //   }
    // }
   
  });
</script>
@endsection