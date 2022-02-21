@extends('super/main')

@section('title', 'Remark')

@section('section-header')
<h1>Remark</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ url('/session_monitor') }}">Monitor</a></div>
</div>   
@endsection

@section('section-title')
Session {{ $session->year }} periode {{ $session->period }}
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
          <td width="50px" align="center" scope="col"><b>Remark</b></td>
          <td width="50px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($remark_ap_file as $remark_ap_file)
        <tr>
          <td align="center">{{ $loop->iteration }}</td>
          <td align="left">{{ $remark_ap_file->remark }}</td>
          <td align="center">
            <a href="{{ route('sessions.remark_ap_files.aplication_ratings.index_session', [$session, $remark_ap_file]) }}" class="btn btn-info fas fa-lock-open"> Open</a>
          </td>
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection