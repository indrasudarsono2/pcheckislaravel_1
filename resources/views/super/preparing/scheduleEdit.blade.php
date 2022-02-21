@extends('super/main')

@section('title', 'Edit Schedule')
    
@section('section-header')
<h1>Edit Schedule</h1>    
@endsection

@section('section-title')
    Edit Schedule Form
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form method="post" action="{{ route('schedules.update', $schedule) }}">
          @method('patch')
          @csrf

          <div class="form-group">
            <label for="schedule_start">Schedule Start</label>
            <input type="date" class="form-control @error('schedule_start') is-invalid @enderror" 
             id="schedule_start" name="schedule_start" placeholder="" value="{{ $schedule->schedule_start->format('Y-m-d') }}">
            @error('schedule_start')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="form-group">
            <label for="schedule_finish">Schedule Finish</label>
            <input type="date" class="form-control @error('schedule_finish') is-invalid @enderror" 
             id="schedule_finish" name="schedule_finish" placeholder="" value="{{ $schedule->schedule_finish->format('Y-m-d') }}">
            @error('schedule_finish')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          
          <button type="submit" class="btn btn-success fas fa-edit"> Edit Schedule</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection