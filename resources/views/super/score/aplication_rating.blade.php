@extends('super/main')

@section('title', 'Rating')

@section('section-header')
<h1>Rating</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ route('score_sessions') }}">{{ $session->year }}-{{ $session->period }}</a></div>
  <div class="breadcrumb-item active"><a href="{{ route('sessions.activities.index', $session) }}">{{ $activity->activity }}</a></div>
  <div class="breadcrumb-item active"><a href="{{ route('sessions.activities.remark_ap_files.index', [$session, $activity]) }}">{{ $remark_ap_file->remark }}</a></div>
</div> 
@endsection

@section('section-title')
Rating    
@endsection

@section('contain')

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
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <td width="10px" align="center" scope="col"><b>No</b></td>
          <td width="50px" align="center" scope="col"><b>Rating</b></td>
          <td width="50px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($aplication_rating as $aplication_rating)
        <tr>
          <td align="center">{{ $loop->iteration }}</td>
          <td align="center">{{ $aplication_rating->rating->rating }}</td>
          <td align="center">
            <a href="{{ route('sessions.activities.remark_ap_files.aplication_ratings.scoress.index', [$session, $activity, $remark_ap_file, $aplication_rating]) }}" class="btn btn-info fas fa-lock-open"> Open</a>
          </td>
          
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection