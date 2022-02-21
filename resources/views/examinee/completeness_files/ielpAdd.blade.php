@extends('examinee/main')

@section('title', 'IELP')
    
@section('section-header')
<h1>IELP's Data</h1>    
@endsection

@section('section-title')
    Datas
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form action="/ielpp" method="post">
         
          @csrf
          <div class="form-group row">
            <label for="rater" class="col-sm-2 col-form-label"><font size="3px">Nama Rater</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error ('rater') is-invalid @enderror" 
              id="rater" name="rater" value="{{ old('rater') }}">
              @error('rater')<div class="invalid-feedback">{{ $message }}</div>@enderror  
            </div>
          </div>

          <div class="form-group row">
            <label for="institution" class="col-sm-2 col-form-label"><font size="3px">Lembaga Pelatihan</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error ('institution') is-invalid @enderror" 
              id="institution" name="institution" value="{{ old('institution') }}">
              @error('institution')<div class="invalid-feedback">{{ $message }}</div>@enderror  
            </div>
          </div>

          <div class="form-group row">
            <label for="ielp_date" class="col-sm-2 col-form-label"><font size="3px">Tanggal dikeluarkan</font></label>
            <div class="col-sm-10">
              <input type="date" name="ielp_date" class="form-control @error ('ielp_date') is-invalid @enderror" value="{{ old('ielp_date') }}" id="ielp_date">
              @error('ielp_date')<div class="invalid-feedback">{{ $message }}</div>@enderror  
            </div>
          </div>

          <div class="form-group row">
            <label for="level" class="col-sm-2 col-form-label"><font size="3px">Level</font></label>
            <div class="col-sm-10">
              <select name="levell" id="level" class="form-control @error ('levell') is-invalid @enderror">
                <option value="" ></option>
                <option value="4" {{ (old('levell') == 4) ? 'selected' : '' }}>Level 4</option>
                <option value="5" {{ (old('levell') == 5) ? 'selected' : '' }}>Level 5</option>
                <option value="6" {{ (old('levell') == 6) ? 'selected' : '' }}>Level 6</option>
              </select>
            </div>
          </div>

          <div class="form-group row" id="ielpInput">
            <label for="expiredielp" class="col-sm-2 col-form-label"><font size="3px">Ielp's Expired</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error ('ielpExpired') is-invalid @enderror" 
              id="expiredIelp" name="ielpExpired" value="{{ old('ielpExpired') }}" readonly>
              @error('ielpExpired')<div class="invalid-feedback">{{ $message }}</div>@enderror  
            </div>
          </div>
          <button type="submit" class="btn btn-primary fas fa-plus" id="create"> Add</button>
        </form>
        
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/length.js') }}"></script>
@endsection