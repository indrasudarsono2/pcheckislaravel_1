@extends('super/main')

@section('title', 'Session')

@section('section-header')
<h1>Session</h1>
@endsection

@section('section-title')
Session    
@endsection

@section('contain')
<a href="sessions/create" class="btn btn-primary fas fa-plus-square"> Add session</a>
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
          <td width="10px" align="center" scope="col"><b>ID</b></td>
          <td width="50px" align="center" scope="col"><b>Year</b></td>
          <td width="50px" align="center" scope="col"><b>Period</b></td>
          <td width="100px" align="center" scope="col"><b>Text</b></td>
          <td width="50px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($session as $session)
        <tr>
          <td align="center">{{ $loop->iteration }}</td>
          <td align="center">{{ $session->year }}</td>
          <td align="center">{{ $session->period }}</td>
          <td align="center">{{ $session->text }}</td>
          <td align="center">
            <a href="/sessions/{{ $session->id }}/edit" class="btn btn-success fas fa-edit"></a>
            <form action="/sessions/{{ $session->id }}" method="post" class="d-inline">
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