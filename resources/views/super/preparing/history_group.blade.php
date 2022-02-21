@extends('super/main')

@section('title', 'History Group')

@section('section-header')
<h1>History</h1>
@endsection

@section('section-title')
Group    
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
          <td width="50px" align="center" scope="col"><b>Group Name</b></td>
          <td width="50px" align="center" scope="col"><b>Checker</b></td>
          <td width="50px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($group_history as $group_history)
        <tr>
          <td align="center">{{ $loop->iteration }}</td>
          <td align="center">{{ $group_history->name }}</td>
          <td align="left">{{ $group_history->user->name }}</td>
          <td align="center">
            <a href="/groups_history/{{ $group_history->id }}/group_members" class="btn btn-info fas fa-user"></a>
          </td>
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection