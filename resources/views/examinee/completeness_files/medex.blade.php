@extends('examinee/main')

@section('title', 'Medex')

@section('section-header')
<h1>Medex</h1>
@endsection

@section('section-title')
Mine    
@endsection

@section('contain')
<a href="med/create" class="btn btn-primary fas fa-plus-square"> Add medex</a>
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
          <td width="10px" align="center" scope="col"><b>ID</b></td>
          <td width="50px" align="center" scope="col"><b>License Number</b></td>
          <td width="200px" align="center" scope="col"><b>Name</b></td>
          <td width="30px" align="center" scope="col"><b>Released</b></td>
          <td width="30px" align="center" scope="col"><b>Expired</b></td>
          <td width="30px" align="center" scope="col"><b>Examiner</b></td>
          <td width="30px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($medex as $medex)
        <tr>
          <td align="center">{{ $loop->iteration }}</th>
          <td align="center">{{ $medex->user_id }}</td>
          <td align="left">{{ $medex->user->name }}</td>
          <td align="center">{{ $medex->released->format('d/m/Y') }}</td>
          <td align="center">{{ $medex->expired->format('d/m/Y') }}</td>
          <td align="center">{{ $medex->examiner }}</td>
          <td align="center">
            <a href="medex/{{ $medex->id }}/edit" class="btn btn-success fas fa-edit"></a>
            <form action="/medex/{{ $medex->id }}" method="post" class="d-inline">
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