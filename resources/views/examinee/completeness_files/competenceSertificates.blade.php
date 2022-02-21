@extends('examinee/main')

@section('title', 'Competence Sertificate')

@section('section-header')
<h1>Competence Sertificates</h1>
@endsection

@section('section-title')
Mine    
@endsection

@section('contain')
<a href="competence_sertificates/create" class="btn btn-primary fas fa-plus-square"> Add Sertificate</a>
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
          <td width="50px" align="center" scope="col"><b>Competence Sertificate</b></td>
          <td width="50px" align="center" scope="col"><b>Institution</b></td>
          <td width="50px" align="center" scope="col"><b>Released</b></td>
          <td width="50px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($sertificate_owner as $so)
        <tr>
          <td align="center">{{ $loop->iteration }}</th>
          <td align="center">{{ $so->sertificate->sertificate }}</td>
          <td align="center">{{ $so->institution }}</td>
          <td align="center">{{ $so->released->format('d/m/Y') }}</td>
          <td align="center">
            <a href="competence_sertificates/{{ $so->id }}/edit" class="btn btn-success fas fa-edit"></a>
            <form action="/competence_sertificates/{{ $so->id }}" method="post" class="d-inline">
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