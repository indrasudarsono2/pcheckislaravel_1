@extends('super/main')

@section('title', 'Essay')

@section('section-header')
<h1>Essay {{$group_member->user->name}}</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ route('groups.group_members.index', $group) }}">Examinee</a></div>
</div> 
@endsection

@section('section-title')
Rating
@endsection

@section('contain')
<div class="card">
  <div class="table-responsive">
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
          <td width="50px" align="center" scope="col"><b>No</b></td>
          <td width="50px" align="center" scope="col"><b>Rating</b></td>
          <td width="30px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($form_rating as $form_rating)
        <tr>
          <td width="50px" align="center" scope="col">{{ $loop->iteration }}</td>
          <td width="50px" align="center" scope="col">{{ $form_rating->rating->rating }}</td>
          <td width="30px" align="center" scope="col">
            <a href="{{ route('groups.group_member.form_ratings', [$group,$group_member, $form_rating]) }}" class="btn btn-success fas fa-edit "> Check</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection