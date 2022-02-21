@extends('super/main')

@section('title', 'Group')

@section('section-header')
<h1>Group</h1>
@endsection

@section('section-title')
Group    
@endsection

@section('contain')
<a href="groupss/create" class="btn btn-primary fas fa-plus-square"> Add group</a>
<a href="groupss_history" class="btn btn-info fas fa-book"> History</a>
<a href="groupss_table" class="btn btn-warning fas fa-table"> Table</a>
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
        @foreach ($group as $group)
        <tr>
          <td align="center">{{ $loop->iteration }}</td>
          <td align="center">{{ $group->name }}</td>
          <td align="left">{{ $group->user->name }}</td>
          <td align="center">
            <a href="/groups/{{ $group->id }}/edit" class="btn btn-success fas fa-edit"></a>
            <a href="/groups/{{ $group->id }}/group_members" class="btn btn-info fas fa-user"></a>
            <form action="/groups/{{ $group->id }}" method="post" class="d-inline">
              @method('delete')
              @csrf
            <button type="submit" class="btn btn-danger fas fa-trash" onclick="return confirm('Are you sure want to delete this data?')"> 
            Temporary
            </button>
            </form>
            <form action="/groupss_history/{{ $group->id }}" method="post" class="d-inline">
              @method('delete')
              @csrf
            <button type="submit" class="btn btn-dark fas fa-trash" onclick="return confirm('Are you sure want to delete this data?')"> 
            Permanent
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