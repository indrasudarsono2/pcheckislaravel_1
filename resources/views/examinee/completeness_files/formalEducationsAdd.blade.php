@extends('examinee/main')

@section('title', 'Formal education')
    
@section('section-header')
<h1>Formal Education's Data</h1>    
@endsection

@section('section-title')
    Add Formal Education
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form action="/formal_educations" method="post">
         
          @csrf
          <div class="form-group row">
            <label for="formal_education" class="col-sm-2 col-form-label"><font size="3px">Formal Education</font></label>
            <div class="col-sm-10">
              <select name="formal_education_id" 
              class="form-control @error ('formal_education_id') is-invalid @enderror">
                <option value=""></option>
                @foreach ($formal_education as $formal_education)
                <option value="{{ $formal_education->id }}" {{ (old('formal_education_id') == $formal_education->id) ? 'selected' : '' }}>{{ $formal_education->education }}</option>
               @endforeach
            </select>
            @error('formal_education_id') <div class="invalid-feedback">{{ $message }}</div>@enderror 
            </div>
          </div>

          <div class="form-group row">
            <label for="year" class="col-sm-2 col-form-label"><font size="3px">Year</font></label>
            <div class="col-sm-10">
              <input type="year" class="form-control @error ('year') is-invalid @enderror" 
              id="year" name="year" value="{{ old('year') }}">
              @error('year')<div class="invalid-feedback">{{ $message }}</div>@enderror  
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