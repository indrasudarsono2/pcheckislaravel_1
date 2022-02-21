@extends('super/main')

@section('title', 'Add Examinee')
    
@section('section-header')
<h1>Add Examinee</h1>    
@endsection

@section('section-title')
    Add Examinee Form
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form method="post" action="{{route('sessions.gain_ratingss.store', $session)}}">
          @csrf

          <div class="form-group">
            <label for="period">Examinee</label>
            <select name="examinee" id="examinee" 
            class="form-control @error ('examinee') is-invalid @enderror">
                <option value=""></option>
                @foreach ($examinee as $examinee)
                <option value="{{ $examinee->id }}" {{ (old('examinee') == $examinee->id) ? 'selected' : '' }}>{{ $examinee->name }}</option>
                @endforeach
            </select>
            @error('examinee') <div class="invalid-feedback">{{ $message }}</div>@enderror      
          </div>
          
          <button type="submit" class="btn btn-primary fas fa-plus-square"> Add Examinee</button>
        </form>
      </div>
    </div>
  </div>
</div>
 @endsection