@extends('super/main')

@section('title', 'Group Member')

@section('section-header')
<h1>Group {{ $group->name }}</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ url('/groupss') }}">Group</a></div>
</div>   
@endsection

@section('section-title')
{{ $group->user->name }}    
@endsection

@section('contain')
<a href="group_members/create" class="btn btn-primary fas fa-plus-square"> Add member</a>
<a href="/groupss" class="btn btn-info fas fa-arrow-alt-circle-left"></i> Back</a>

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
          <td width="50px" align="center" scope="col"><b>Name</b></td>
          <td width="50px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($group_member as $group_member)
        <tr>
          <td align="center">{{ $loop->iteration }}</td>
          <td align="left">{{ $group_member->user->name }}</td>
          <td align="center">
            <form action="/groups/{{ $group->id }}/group_members/{{ $group_member->id }}" method="post" class="d-inline">
              @method('delete')
              @csrf
            <button type="submit" class="btn btn-danger fas fa-trash" onclick="return confirm('Are you sure want to delete this data?')"> 
            </button>
            </form>
            @if ($gm_id!=0)
              @for($i=0; $i<count($gm_id); $i++)
                @if($group_member->id == $gm_id[$i])
                <a href="{{ route('groups.group_member.show', [$group, $group_member]) }}" class="btn btn-dark fas fa-book "> Essay</a>
                @break
                @endif
              @endfor 
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection