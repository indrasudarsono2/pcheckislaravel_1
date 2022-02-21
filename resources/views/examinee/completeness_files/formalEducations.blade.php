@extends('examinee/main')

@section('title', 'Formal Education')

@section('section-header')
<h1>Formal Educations</h1>
@endsection

@section('section-title')
Mine    
@endsection

@section('contain')
<a href="formal_educations/create" class="btn btn-primary fas fa-plus-square"> Add Education</a>
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
          <td width="50px" align="center" scope="col"><b>Formal Education</b></td>
          <td width="50px" align="center" scope="col"><b>Year</b></td>
          <td width="50px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($education_owner as $eo)
        <tr>
          <td align="center">{{ $loop->iteration }}</th>
          <td align="center">{{ $eo->formal_education->education }}</td>
          <td align="center">{{ $eo->year }}</td>
          <td align="center">
            <a href="formal_educations/{{ $eo->id }}/edit" class="btn btn-success fas fa-edit"></a>
            <form action="/formal_educations/{{ $eo->id }}" method="post" class="d-inline">
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