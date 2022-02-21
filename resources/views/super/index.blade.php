@extends('super/main')

@section('title', 'Dashboard Super Admin')

@section('section-header')
<h1>Dashboard</h1>
@endsection

@section('section-title')
Announcement    
@endsection

@section('contain')
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
<div class="card">
  <div class="table-responsive">
     <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <td width="10px" align="center" scope="col"><b>No</b></td>
          <td width="50px" align="center" scope="col"><b>No. License</b></td>
          <td width="50px" align="center" scope="col"><b>Name</b></td>
          <td width="50px" align="center" scope="col"><b>Status</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($user as $u)
        <tr>
          <td align="center">{{ $user->firstItem()+$loop->iteration-1 }}</td>
          <td align="center">{{ $u->id }}</td>
          <td align="left">{{ $u->name }}</td>
          @if ($u->isOnline())
          <td align="center"><font style="color: green">Online</font></td> 
          @else
          <td align="center"><font style="color: red">Offline</font></td> 
          @endif
          
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $user->links() }}
  </div>
</div>
@endsection
    
