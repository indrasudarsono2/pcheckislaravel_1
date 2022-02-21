@extends('super/main')

@section('title', 'Edit Examinee')
    
@section('section-header')
<h1>Edit Examinee</h1>    
@endsection

@section('section-title')
    Edit Examinee Form
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form method="post" action="{{ route('sessions.gain_ratings.update', [$session, $gain_rating]) }}">
          @csrf
          @method('patch')
          <div class="form-group">
            <label for="period">Examinee</label>
            <select name="examinee" id="examinee" 
            class="form-control @error ('examinee') is-invalid @enderror">
              <option value="{{ $gain_rating->user_id }}">{{ $gain_rating->user->name }}</option>
                @foreach ($examinee as $examinee)
                <option value="{{ $examinee->id }}" {{ (old('examinee') == $examinee->id) ? 'selected' : '' }}>{{ $examinee->name }}</option>
                @endforeach
            </select>
            @error('examinee') <div class="invalid-feedback">{{ $message }}</div>@enderror      
          </div>
          
          <button type="submit" class="btn btn-success fas fa-edit"> Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>
 @endsection