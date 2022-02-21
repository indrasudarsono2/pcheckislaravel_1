@extends('examinee/main')

@section('title', 'Performance Check')

@section('section-header')
<h1>Performance Check</h1>
@endsection

@section('section-title')
Checking list
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
          <td width="50px" align="center" scope="col"><b>Aplication File ID</b></td>
          <td width="50px" align="center" scope="col"><b>Nomor License</b></td>
          <td width="150px" align="center" scope="col"><b>Nama</b></td>
          <td width="30px" align="center" scope="col"><b>Rating</b></td>
          <td width="30px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($form_rating as $form_rating)
        <tr>
          <td width="50px" align="center" scope="col">{{ $form_rating->aplication_file->number }}</td>
          <td width="50px" align="center" scope="col">{{ Auth::id() }}</td>
          <td width="150px" align="left" scope="col">{{ Auth::user()->name }}</td>
          <td width="30px" align="center" scope="col">{{ $form_rating->rating->rating }}</td>
          <td width="30px" align="center" scope="col">
            @if($form_rating->aplication_file->status_id==2 && $form_rating->aplication_file->provision_date!=null)
              <a href="{{ route('form_ratings.performance_checks.index', $form_rating) }}" class="btn btn-info fas fa-box-open "> Open</a>   
            @else
              NOT PERMITTED YET
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection