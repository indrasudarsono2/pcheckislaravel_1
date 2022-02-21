@extends('super/main')

@section('title', 'Edit Session')
    
@section('section-header')
<h1>Edit Session</h1>    
@endsection

@section('section-title')
    Edit Session Form
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form method="post" action="/sessions/{{ $session->id }}">
          @method('patch')
          @csrf

          <div class="form-group">
            <label for="year">Year</label>
            <input type="number" min="2018" max="2999" class="form-control @error('year') is-invalid @enderror" 
             id="year" name="year" placeholder="Year example : 2018" value="{{ $session->year }}">
            @error('year')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="form-group">
            <label for="period">period</label>
            <select name="period" id="period" 
            class="form-control @error ('period') is-invalid @enderror">
              <option value="1" {{ $session->period == 1 ? 'selected' : '' }}>1 period</option>
              <option value="2" {{ $session->period == 2 ? 'selected' : '' }}>2 period</option>
            </select>
            @error('period') <div class="invalid-feedback">{{ $message }}</div>@enderror      
          </div>

          <div class="form-group">
            <label for="text">Text</label>
            <input type="text" class="form-control @error('text') is-invalid @enderror" 
             id="text" name="text" placeholder="Free text for score result" value="{{ $session->text }}">
            @error('text')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          
          <button type="submit" class="btn btn-success fas fa-edit"> Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>
  


@endsection