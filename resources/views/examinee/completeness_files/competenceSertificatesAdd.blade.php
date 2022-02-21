@extends('examinee/main')

@section('title', 'Competence Sertificate')
    
@section('section-header')
<h1>Competence Sertificate's Data</h1>    
@endsection

@section('section-title')
    Add Sertificate
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form action="/competence_sertificates" method="post">
         
          @csrf
          <div class="form-group row">
            <label for="sertificate" class="col-sm-2 col-form-label"><font size="3px">Competence Sertificate</font></label>
            <div class="col-sm-10">
              <select name="sertificate_id" 
              class="form-control @error ('sertificate_id') is-invalid @enderror">
                <option value=""></option>
                @foreach ($sertificate_owner as $so)
                <option value="{{ $so->id }}" {{ (old('sertificate_id') == $so->id) ? 'selected' : '' }}>{{ $so->sertificate }}</option>
               @endforeach
            </select>
            @error('sertificate_id') <div class="invalid-feedback">{{ $message }}</div>@enderror 
            </div>
          </div>

          <div class="form-group row">
            <label for="released" class="col-sm-2 col-form-label"><font size="3px">Released</font></label>
            <div class="col-sm-10">
              <input type="date" class="form-control @error ('released') is-invalid @enderror" 
              id="released" name="released" value="{{ old('released') }}">
              @error('released')<div class="invalid-feedback">{{ $message }}</div>@enderror  
            </div>
          </div>

          <div class="form-group row">
            <label for="institution" class="col-sm-2 col-form-label"><font size="3px">Institution</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error ('institution') is-invalid @enderror" 
              id="institution" name="institution" value="{{ old('institution') }}">
              @error('institution')<div class="invalid-feedback">{{ $message }}</div>@enderror  
            </div>
          </div>

          
          <button type="submit" class="btn btn-primary fas fa-plus"> Add</button>
        </form>
        
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/length.js') }}"></script>
@endsection