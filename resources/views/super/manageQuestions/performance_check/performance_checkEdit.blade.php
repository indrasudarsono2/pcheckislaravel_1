@extends('super/main')

@section('title', 'Add Varian')
    
@section('section-header')
<h1>Add Varian</h1>    
@endsection

@section('section-title')
    Add Varian Form
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form method="post" action="{{ route('aplication_ratings.performance_checks.update', [$aplication_rating, $performance_check]) }}">
          @csrf
          @method('patch')
          <fieldset class="form-group">
            <div class="row">
              <label class="col-form-label col-sm-2 pt-0"><font size="3px" color="black">Question's Varian</font></label>
              <div class="col-sm-10">
                <div class="form-check form-check-inline">
                  <input class="form-check-input  @error ('varian') is-invalid @enderror @error('quantity') is-invalid @enderror" type="radio" name="varian" 
                    value="{{$performance_check->question_varian_id}}" checked disabled>
                  <label class="form-check-label" for="varian">
                    {{ $performance_check->question_varian->varian }}
                  </label>
                </div>
              </div>
            </div>
          </fieldset>
          
          <div class="form-group row">
            <label for="quantity" class="col-sm-2 col-form-label"><font size="3px">Quantity</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('quantity') is-invalid @enderror" 
              id="quantity" name="quantity" placeholder="Quantity" value="{{ $performance_check->quantity }}" readonly>
              @error('quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
                            
          <div class="form-group row">
            <label for="persentage" class="col-sm-2 col-form-label"><font size="3px">Persentage</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('persentage') is-invalid @enderror" 
              id="persentage" name="persentage" placeholder="Persentage example: 0.8" value="{{ $performance_check->persentage }}">
              @error('persentage')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
          
          <div class="form-group row">
            <label for="minute" class="col-sm-2 col-form-label"><font size="3px">Minute</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('minute') is-invalid @enderror" 
              id="minute" name="minute" placeholder="In minute, example: 90" value="{{ $performance_check->minute }}">
              @error('minute')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
          
             
          <button type="submit" class="btn btn-success fas fa-edit"> Edit Varian</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/varian.js') }}"></script>
@endsection