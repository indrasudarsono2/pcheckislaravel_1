@extends('super/main')

@section('title', 'Rating')

@section('section-header')
<h1>Rating</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ url('/session_monitor') }}">Monitor</a></div>
  <div class="breadcrumb-item active"><a href="{{ route('sessions.remark_ap_files.index_session', $session) }}">Remark</a></div>
</div> 
@endsection

@section('section-title')
{{ $remark_ap_file->remark }}   
@endsection

@section('contain')

<div class="card">
  <div class="table-responsive">
    
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
            <a href="{{ route('sessions.remark_ap_files.aplication_ratings.show', [$session, $remark_ap_file, $aplication_rating]) }}" class="btn btn-info fas fa-lock-open"> Open</a>
          </td>
          
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection