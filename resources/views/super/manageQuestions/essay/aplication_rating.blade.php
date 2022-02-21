@extends('super/main')

@section('title', 'Type of question')

@section('section-header')
<h1>Type of question</h1>
@endsection

@section('section-title')
Essay Question
@endsection

@section('contain')
<div class="card">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <td width="50px" align="center" scope="col"><b>No</b></td>
          <td width="50px" align="center" scope="col"><b>Rating</b></td>
          <td width="30px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($aplication_rating as $aplication_rating)
        <tr>
          <td width="50px" align="center" scope="col">{{ $loop->iteration }}</td>
          <td width="50px" align="left" scope="col">({{ $aplication_rating->rating->rating }}) {{$aplication_rating->rating->full}}</td>
          <td width="30px" align="center" scope="col">
            <a href="{{ route('aplication_ratings.essay_groups.index', $aplication_rating) }}" class="btn btn-warning fas fa-tasks"> Manage Group</a>
            <a href="{{ route('aplication_ratings.essays.index', $aplication_rating) }}" class="btn btn-info fas fa-tasks"> Manage Question</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection