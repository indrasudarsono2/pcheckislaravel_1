@extends('examinee/main')

@section('title', 'Medex')
    
@section('section-header')
<h1>Medex's Data</h1>    
@endsection

@section('section-title')
    Datas
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form action="/medex/{{ $medex->id }}" method="post">
          @method('patch')
          @csrf
           <div class="form-group row">
            <label for="date_of_birth" class="col-sm-2 col-form-label"><font size="3px">Tanggal Lahir</font></label>
            <div class="col-sm-10">
              <input type="date" name="date_of_birth" class="form-control  @error ('date_of_birth') is-invalid @enderror" value="{{ $b_day->date_of_birth->format('Y-m-d') }}" id="date_of_birth" readonly>
              @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="age" class="col-sm-2 col-form-label"><font size="3px">Umur</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control  @error ('age') is-invalid @enderror" 
              id="age" name="age" value="{{ $age }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="medex_date" class="col-sm-2 col-form-label"><font size="3px">Tanggal dikeluarkan</font></label>
            <div class="col-sm-10">
              <input type="date" name="medex_date" class="form-control  @error ('medex_date') is-invalid @enderror" value="{{ $medex->released->format('Y-m-d') }}" id="medex_date">
              @error('medex_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
  
          <div class="form-group row" id="medexInput">
            <label for="expiredMedex" class="col-sm-2 col-form-label"><font size="3px">Medex's Expired</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control  @error ('medexExpired') is-invalid @enderror" 
              id="expiredMedex" name="medexExpired" value="{{ $medex->expired->format('d-m-Y') }}" readonly>
              @error('medexExpired')<div class="invalid-feedback">{{ $message }}</div>@enderror  
            </div>
           
          </div>
       
          <div class="form-group row">
            <label for="examiner" class="col-sm-2 col-form-label"><font size="3px">Nama Penguji</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control  @error ('examiner') is-invalid @enderror" 
              name="examiner" value="{{ $medex->examiner }}">
              @error('examiner')<div class="invalid-feedback">{{ $message }}</div>@enderror
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