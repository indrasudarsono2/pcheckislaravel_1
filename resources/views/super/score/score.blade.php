@extends('super/main')

@section('title', 'Score ')

@section('section-header')
<h1>Score </h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ route('score_sessions') }}">{{ $session->year }}-{{ $session->period }}</a></div>
  <div class="breadcrumb-item active"><a href="{{ route('sessions.activities.index', $session) }}">{{ $activity->activity }}</a></div>
  <div class="breadcrumb-item active"><a href="{{ route('sessions.activities.remark_ap_files.index', [$session, $activity]) }}">{{ $remark_ap_file->remark }}</a></div>
  <div class="breadcrumb-item active"><a href="{{ route('sessions.activities.remark_ap_files.aplication_ratings2.index', [$session, $activity, $remark_ap_file]) }}">{{ $aplication_rating->rating->rating }}</a></div>
</div> 
@endsection

@section('section-title')
Score     
@endsection

@section('contain')
<div class="row">
  <div class="col-md-6">
    <form method="post" action="{{ route('sessions.activities.remark_ap_files.aplication_ratings.scoress.store', [$session, $activity, $remark_ap_file, $aplication_rating]) }}">
      @csrf
      <input type="date" name="start">
      <input type="date" name="end">
      <button type="submit" class="btn btn-info fas fa-print"> Print recapitulation</button>
    </form>
  </div>
  <div class="col-md-6">
    <form method="post" action="{{ route('score_attendance', [$session, $activity, $remark_ap_file, $aplication_rating]) }}">
      @csrf
      <input type="date" name="start">
      <input type="date" name="end">
      <button class="btn btn-primary fas fa-print"> Print attendance</button>
    </form>
  </div>
</div>
<div class="card">
  <div class="table-responsive">
    @if (session('status'))
      <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="success">
            <span>×</span>
          </button>
          {{ session('status') }}
        </div>
      </div>
    @endif
    <div id="container">
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <td width="10px" align="center" scope="col"><b>No</b></td>
            <td width="10px" align="center" scope="col"><b>Tanggal</b></td>
            <td width="50px" align="center" scope="col"><b>Name</b></td>
            <td width="50px" align="center" scope="col"><b>Score</b></td>
            <td width="50px" align="center" scope="col"><b>Remark</b></td>
            <td width="50px" align="center" scope="col"><b>Action</b></td>
          </tr>
        </thead>
        <tbody>
          @foreach ($score as $score)
          <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="center">{{ $score->updated_at->format('d-m-Y H:i:s') }}</td>
            <td align="left">{{ $score->form_rating->aplication_file->user->name }}</td>
            <td align="center">{{ $score->score }}</td>
            <td align="center">{{ $score->remark_score->remark }}</td>
            <td align="center">
              <a href="{{ route('sessions.activities.remark_ap_files.aplication_ratings.scores.show', [$session, $activity, $remark_ap_file, $aplication_rating, $score]) }}" class="btn btn-info fas fa-print"> Print</a>
            @if(Auth::user()->remark_id==1 && $score->remark_score_id != 1)
              <a href="{{ route('sessions.activities.remark_ap_files.aplication_ratings.scores.edit', [$session, $activity, $remark_ap_file, $aplication_rating, $score]) }}" class="btn btn-primary fas fa-print"> Result</a>   
            @endif  
            </td>
            
          </tr>
  
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection