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
        <form action="/competence_sertificates/{{ $competence_sertificate->id }}" method="post">
         @method('patch');
          @csrf
          <div class="form-group row">
            <label for="sertificate" class="col-sm-2 col-form-label"><font size="3px">Competence Sertificate</font></label>
            <div class="col-sm-10">
              <select name="sertificate_id" 
              class="form-control @error ('sertificate_id') is-invalid @enderror">
                <option value="{{ $competence_sertificate->sertificate_id }}">{{ $competence_sertificate->sertificate->sertificate }}</option>
                @foreach ($so as $so)
                <option value="{{ $so->id }}">{{ $so->sertificate }}</option>
               @endforeach
            </select>
            @error('sertificate_id') <div class="invalid-feedback">{{ $message }}</div>@enderror 
            </div>
          </div>

          <div class="form-group row">
            <label for="released" class="col-sm-2 col-form-label"><font size="3px">Released</font></label>
            <div class="col-sm-10">
              <input type="date" class="form-control @error ('released') is-invalid @enderror" 
              name="released" value="{{ $competence_sertificate->released->format('Y-m-d') }}">
              @error('released')<div class="invalid-feedback">{{ $message }}</div>@enderror  
            </div>
          </div>

          <div class="form-group row">
            <label for="institution" class="col-sm-2 col-form-label"><font size="3px">Institution</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error ('institution') is-invalid @enderror" 
              id="institution" name="institution" value="{{ $competence_sertificate->institution }}">
              @error('institution')<div class="invalid-feedback">{{ $message }}</div>@enderror  
            </div>
          </div>

          
          <button type="submit" class="btn btn-success fas fa-edit"> Edit</button>
        </form>
        
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/length.js') }}"></script>
@endsection