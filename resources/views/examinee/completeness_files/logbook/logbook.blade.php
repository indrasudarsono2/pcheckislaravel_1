@extends('examinee/main')

@section('title', 'Logbook')

@section('section-header')
<h1>Logbook</h1>
@endsection

@section('section-title')
Mine    
@endsection

@section('contain')
<a href="logbookss/create" class="btn btn-primary fas fa-plus-square"> Add Logbook</a>
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
          <td width="50px" align="center" scope="col"><b>Latest Update</b></td>
          <td width="50px" align="center" scope="col"><b>Comment</b></td>
          <td width="100px" align="center" scope="col"><b>Log Book</b></td>
          <td width="30px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($logbook as $logbook)
        <tr>
          <td align="center">{{ $loop->iteration }}</th>
          <td align="center">{{ $logbook->updated_at->format('d F Y H:i:s') }}</td>
          <td align="center">{{ $logbook->comment }}</td>
          <td align="center"><a href="{{ route('logbooks.show', $logbook->id) }}" class="fas fa-eye"> See</a></td>
          <td align="center">
            <a href="{{ route('logbooks.edit', $logbook->id) }}" class="btn btn-success fas fa-edit"></a>
            <form action="{{ route('logbooks.destroy', $logbook->id) }}" method="post" class="d-inline">
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