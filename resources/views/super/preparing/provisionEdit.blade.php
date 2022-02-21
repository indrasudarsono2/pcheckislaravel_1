@extends('super/main')

@section('title', 'Edit Debriefing')
    
@section('section-header')
<h1>Edit Debriefing</h1>    
@endsection

@section('section-title')
    Edit Debriefing Form
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form method="post" action="{{ route('provisions.update', $provision) }}">
          @method('patch')
          @csrf

          <div class="form-group">
            <label for="token">Token</label>
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <input type="text" class="form-control @error('token') is-invalid @enderror" 
                id="token" name="token" placeholder="" value="{{ $provision->token }}">
                @error('token')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt-1">
                <a href="#" class="btn btn-info fas fa-cogs" id="generate"> Generate</a>
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label for="validity">Validity</label>
            <input type="datetime-local" class="form-control @error('validity') is-invalid @enderror" 
             id="validity" name="validity" placeholder="" value="{{ $provision->validity->format('Y-m-d\TH:i:s') }}">
            @error('validity')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          
          <button type="submit" class="btn btn-success fas fa-edit"> Edit Provision</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/generate.js') }}"></script>
@endsection