@extends('examinee/main')

@section('title', 'Session')

@section('section-header')
<h1>Session</h1>
@endsection

@section('section-title')
Session    
@endsection

@section('contain')
<div class="card">
  <div class="table-responsive">
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
          <td width="50px" align="center" scope="col"><b>Year</b></td>
          <td width="50px" align="center" scope="col"><b>Period</b></td>
          <td width="50px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($sessionss as $sessionss)
        <tr>
          <td align="center">{{ $loop->iteration }}</td>
          <td align="center">{{ $sessionss->year }}</td>
          <td align="center">{{ $sessionss->period }}</td>
          <td align="center">
            <a href="{{ route('sessionss.checker_gains.index', $sessionss) }}" class="btn btn-info fas fa-lock-open"> Open</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection