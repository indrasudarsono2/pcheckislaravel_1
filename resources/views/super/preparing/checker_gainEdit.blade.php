@extends('super/main')

@section('title', 'Edit Checker')
    
@section('section-header')
<h1>Edit Checker</h1>    
@endsection

@section('section-title')
    Edit Checker Form
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form method="post" action="{{ route('sessions.gain_ratings.checker_gains.update', [$session,$gain_rating,$checker_gain]) }}">
          @csrf
          @method('patch')
          
          <div class="form-group">
            <label for="period">Checker</label>
            <select name="checker" id="checker" 
            class="form-control @error ('checker') is-invalid @enderror">
                <option value="{{ $checker_gain->user_id }}">{{ $checker_gain->user->name }}</option>
                @foreach ($checker as $checker)
                <option value="{{ $checker->id }}" {{ (old('checker') == $checker->id) ? 'selected' : '' }}>{{ $checker->name }}</option>
                @endforeach
            </select>
            @error('checker') <div class="invalid-feedback">{{ $message }}</div>@enderror      
          </div>
          
          <button type="submit" class="btn btn-success fas fa-edit"> Edit Checker</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection