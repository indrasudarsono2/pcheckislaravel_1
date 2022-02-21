@extends('super/main')

@section('title', 'Participants')

@section('section-header')
<h1>Participants</h1>
@endsection

@section('section-title')
Participants    
@endsection

@section('contain')
<input type="text" id="keyword" name="keyword" size="40" placeholder="Searching field by name">
<img src="{{ asset('img/loader.gif') }}" class="loader_findFiles">
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
            <td width="200px" align="center" scope="col"><b>License Number</b></td>
            <td width="200px" align="center" scope="col"><b>Name</b></td>
            <td width="200px" align="center" scope="col"><b>Action</b></td>
          </tr>
        </thead>
        <tbody>
          @foreach ($user as $user)
          <tr>
            <td align="center">{{ $loop->iteration }}</th>
            <td align="center">{{ $user->id }}</td>
            <td align="left">{{ $user->name}}</td>
            <td align="center">
              <a href="{{ route('user.session.user_sesion', $user) }}" class="btn btn-info fas fa-lock-open"> Open</a>
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