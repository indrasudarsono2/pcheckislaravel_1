@extends('super/main')

@section('title', 'Schedule')

@section('section-header')
<h1>Schedule</h1>
@endsection

@section('section-title')
Schedule    
@endsection

@section('contain')
@if ($schedule->isEmpty())
<a href="{{ route('schedules.create') }}" class="btn btn-primary fas fa-plus-square"> Add Schedule</a>
@endif
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
          <td width="50px" align="center" scope="col"><b>Schedule Start</b></td>
          <td width="50px" align="center" scope="col"><b>Schedule Finish</b></td>
          <td width="50px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($schedule as $schedule)
        <tr>
          <td align="center">{{ $loop->iteration }}</td>
          <td align="center">{{ $schedule->schedule_start->format('d F Y') }}</td>
          <td align="center">{{ $schedule->schedule_finish->format('d F Y') }}</td>
          <td align="center">
            <a href="{{ route('schedules.edit', $schedule) }}" class="btn btn-success fas fa-edit"></a>
          </td>
          
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection