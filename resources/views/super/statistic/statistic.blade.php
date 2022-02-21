@extends('super/main')

@section('title', 'Statistic')

@section('section-header')
<h1>Statistic</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ url('/session_statistic') }}">Statistic</a></div>
  <div class="breadcrumb-item active"><a href="{{ route('sessions.aplication_ratings.index_statistic', [$session,$aplication_rating]) }}">Rating</a></div>
</div> 
@endsection

@section('section-title')
Session {{ $session->year }}-{{ $session->period }} Rating {{ $aplication_rating->rating->rating }}  
@endsection

@section('contain')

<div class="card">
  <div class="table-responsive">
   
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <td width="10px" align="center" scope="col"><b>ID</b></td>
          <td width="50px" align="center" scope="col"><b>Question</b></td>
          <td width="50px" align="center" scope="col"><b>Amount</b></td>
          <td width="50px" align="center" scope="col"><b>Correct</b></td>
          <td width="50px" align="center" scope="col"><b>Wrong</b></td>
          <td width="50px" align="center" scope="col"><b>Correct Persentage</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($statistic as $statistic)
        <tr>
          <td align="center"><a href="{{ route('sessions.aplication_ratings.statistics.show', [$session, $aplication_rating, $statistic->mc_question_id]) }}">{{ $statistic->mc_question_id }}</a></td>
          <td align="left">{{ $statistic->question }}</td>
          <td align="center">{{ $statistic->appear }}</td>
          <td align="center">{{ $statistic->correct }}</td>
          <td align="center">{{ $statistic->appear-$statistic->correct }}</td>
          <td align="center">{{ $statistic->persentage }}%</td>
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection