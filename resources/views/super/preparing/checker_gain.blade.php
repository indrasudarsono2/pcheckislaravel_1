@extends('super/main')

@section('title', 'Checker Gain')

@section('section-header')
<h1>Defining Checker</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ route('sessions.gain_ratingss.index', $session) }}">Getting Rating</a></div>
</div>   
@endsection

@section('section-title')
{{ $gain_rating->user->name }}    
@endsection

@section('contain')
<a href="{{ route('sessions.gain_ratings.checker_gains.create', [$session, $gain_rating]) }}" class="btn btn-primary fas fa-plus-square"> Add checker</a>
<a href="{{ route('sessions.gain_ratingss.index', $session) }}" class="btn btn-info fas fa-arrow-alt-circle-left"></i> Back</a>

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
          <td width="50px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($checker_gain as $checker_gain)
        <tr>
          <td align="center">{{ $loop->iteration }}</td>
          <td align="left">{{ $checker_gain->user->name }}</td>
          <td align="center">
            
            <a href="{{ route('sessions.gain_ratings.checker_gains.edit', [$session,$gain_rating,$checker_gain]) }}" class="btn btn-success fas fa-edit"></a>
            <form action="{{ route('sessions.gain_ratings.checker_gains.destroy', [$session,$gain_rating,$checker_gain]) }}" method="post" class="d-inline">
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