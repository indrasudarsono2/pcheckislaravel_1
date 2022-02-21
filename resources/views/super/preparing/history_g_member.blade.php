@extends('super/main')

@section('title', 'History')

@section('section-header')
<h1>History Group {{ $group_history->name }}</h1>
@endsection

@section('section-title')
{{ $group_history->user->name }}    
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
          <td width="50px" align="center" scope="col"><b>Name</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($group_member_history as $group_member_history)
        <tr>
          <td align="center">{{ $loop->iteration }}</td>
          <td align="left">{{ $group_member_history->user->name }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection