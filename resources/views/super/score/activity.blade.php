@extends('super/main')

@section('title', 'Activities')

@section('section-header')
<h1>Activities</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ route('score_sessions') }}">{{ $session->year }}-{{ $session->period }}</a></div>
</div>   
@endsection

@section('section-title')
Activities
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
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <td width="10px" align="center" scope="col"><b>No</b></td>
          <td width="50px" align="center" scope="col"><b>Activity</b></td>
          <td width="50px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($activity as $activity)
        <tr>
          <td align="center">{{ $loop->iteration }}</td>
          <td align="left">{{ $activity->activity }}</td>
          <td align="center">
            <a href="{{ route('sessions.activities.remark_ap_files.index', [$session, $activity]) }}" class="btn btn-info fas fa-lock-open"> Open</a>
            
          </td>
          
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection