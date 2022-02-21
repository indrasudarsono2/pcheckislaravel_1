@extends('super/main')

@section('title', 'Gaining Rating')

@section('section-header')
<h1>Gaining Rating</h1>
@endsection

@section('section-title')
Gaining Rating    
@endsection

@section('contain')
<a href="gain_ratingss/create" class="btn btn-primary fas fa-plus-square"> Add Examinee</a>
<a href="/gain_table/{{$session->id}}" class="btn btn-warning fas fa-table"> Table</a>
<a href="{{ url('/session_gain') }}" class="btn btn-info fas fa-arrow-alt-circle-left"></i> Back</a>
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
          <td width="50px" align="center" scope="col"><b>Name</b></td>
          <td width="50px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($gain_rating as $gain_rating)
        <tr>
          <td align="center">{{ $loop->iteration }}</td>
          <td align="left">{{ $gain_rating->user->name }}</td>
          <td align="center">
            <a href="{{route('sessions.gain_ratings.edit', [$session, $gain_rating])}}" class="btn btn-success fas fa-edit"></a>
            <a href="{{ route('sessions.gain_ratings.checker_gains.index', [$session, $gain_rating]) }}" class="btn btn-info fas fa-user"></a>
            <form action="{{route('sessions.gain_ratings.destroy', [$session, $gain_rating])}}" method="post" class="d-inline">
              @method('delete')
              @csrf
            <button type="submit" class="btn btn-danger fas fa-trash" onclick="return confirm('Are you sure want to delete this data?')"> 
            </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection