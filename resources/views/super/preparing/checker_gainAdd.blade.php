@extends('super/main')

@section('title', 'Add Checker')
    
@section('section-header')
<h1>Add Checker</h1>    
@endsection

@section('section-title')
    Add Checker Form
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form method="post" action="{{ route('sessions.gain_ratings.checker_gains.store', [$session, $gain_rating]) }}">
          @csrf

          <div class="form-group">
            <label for="period">Checker</label>
            <select name="checker" id="checker" 
            class="form-control @error ('checker') is-invalid @enderror">
                <option value=""></option>
                @foreach ($checker as $checker)
                <option value="{{ $checker->id }}" {{ (old('checker') == $checker->id) ? 'selected' : '' }}>{{ $checker->name }}</option>
                @endforeach
            </select>
            @error('checker') <div class="invalid-feedback">{{ $message }}</div>@enderror      
          </div>
          
          <button type="submit" class="btn btn-primary fas fa-plus-square"> Add Checker</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection