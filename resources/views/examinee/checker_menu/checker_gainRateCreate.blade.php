@extends('examinee/main')

@section('title', 'Task')

@section('section-header')
<h1>Examinee</h1>
@endsection

@section('section-title')
Rate
@endsection

@section('contain')
<div class="card">
  <div class="table-responsive">
    <div class="card-body">
      <form action="{{ route('sessionss.checker_gains.practical_exams.update', [$sessionss, $checker_gain, $practical_exam]) }}" method="post">
      @method('patch')
      @csrf
        <div class="form-group row">
          <label for="rater" class="col-sm-2 col-form-label"><font size="3px">Nilai</font></label>
          <div class="col-sm-10">
            <input type="text" class="form-control @error ('rate') is-invalid @enderror" 
            id="rate" name="rate" value="{{ $practical_exam->score }}">
            @error('rate')<div class="invalid-feedback">{{ $message }}</div>@enderror  
          </div>
        </div>
        <button type="submit" class="btn btn-primary fas fa-plus"> Rate</button>
      </form>  
    </div>
  </div>
</div>

@endsection