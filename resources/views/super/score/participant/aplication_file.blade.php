@extends('super/main')

@section('title', 'Aplication File')

@section('section-header')
<h1>Aplication File</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ route('user_scores') }}">Participant</a></div>
</div>   
@endsection

@section('section-title')
{{ $user->name }}   
@endsection

@section('contain')
<br>
<br>
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
    <div id="container">
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <td width="10px" align="center" scope="col"><b>No</b></td>
            <td width="200px" align="center" scope="col"><b>Apication File</b></td>
            <td width="200px" align="center" scope="col"><b>Session</b></td>
            <td width="200px" align="center" scope="col"><b>Action</b></td>
          </tr>
        </thead>
        <tbody>
          @foreach ($aplication_file as $aplication_file)
          <tr>
            <td align="center">{{ $loop->iteration }}</th>
            <td align="center">{{ $aplication_file->number }}</td>
            <td align="center">{{ $aplication_file->session->year}}-{{ $aplication_file->session->period}}</td>
            <td align="center">
              <a href="{{ route('user.session.user_sesion.score', [$user, $aplication_file]) }}" class="btn btn-info fas fa-lock-open"> Open</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/findScores.js') }}"></script>
@endsection