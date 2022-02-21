@extends('examinee/main')

@section('title', 'Task')

@section('section-header')
<h1>Examinee</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ route('sessionss.checker_gains.index', $sessionss) }}">Examinee</a></div>
</div> 
@endsection

@section('section-title')
{{ $checker_gain->gain_rating->user->name }}
@endsection

@section('contain')
<a href="{{ route('sessionss.checker_gains.index', $sessionss) }}" class="btn btn-info">Back</a>
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
          <td width="50px" align="center" scope="col"><b>No</b></td>
          <td width="150px" align="center" scope="col"><b>Rating</b></td>
          <td width="150px" align="center" scope="col"><b>Score</b></td>
          <td width="30px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($practical_exam as $practical_exam)
        <tr>
          <td width="50px" align="center" scope="col">{{ $loop->iteration }}</td>
          <td width="150px" align="center" scope="col">{{ $practical_exam->form_rating->rating->rating }}</td>
          <td width="150px" align="center" scope="col">{{ $practical_exam->score }}</td>
          <td width="150px" align="center" scope="col">
            <a href="{{ route('sessionss.checker_gains.practical_exams.edit', [$sessionss, $checker_gain, $practical_exam]) }}" class="btn btn-info fas fa-plus"> Rate</a>
            <form action="{{ route('sessionss.checker_gains.practical_exams.show', [$sessionss, $checker_gain, $practical_exam]) }}" method="get" class="d-inline">
               @csrf
              <button class="btn btn-primary fas fa-plus-square"> Add</button>
            </form>
            @if ($count>1)
            <form action="{{ route('sessionss.checker_gains.practical_exams.destroy', [$sessionss, $checker_gain, $practical_exam]) }}" method="post" class="d-inline" onclick="return confirm('Are you sure want to delete this data?')">
              @method('delete')
              @csrf
              <button class="btn btn-danger fas fa-trash"></button>
            </form> 
            @endif
          </td>  
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection