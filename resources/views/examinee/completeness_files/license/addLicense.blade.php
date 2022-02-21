@extends('examinee/main')

@section('title', 'License')
    
@section('section-header')
<h1>License's Data</h1>    
@endsection

@section('section-title')
  Add License
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form action="/licensess" method="post" enctype="multipart/form-data">
         
          @csrf
          <div class="form-group row">
            <label for="license" class="col-sm-2 col-form-label"><font size="3px">License`s File</font></label>
            <div class="col-sm-10">
              <input type="file" class="form-control @error ('license') is-invalid @enderror" 
              id="license" name="license" value="{{ old('license') }}">
              @error('license')<div class="invalid-feedback">{{ $message }}</div>@enderror  
            </div>
          </div>

          <div class="form-group row">
            <label for="comment" class="col-sm-2 col-form-label"><font size="3px">Comment</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error ('comment') is-invalid @enderror" 
              id="comment" name="comment" value="{{ old('comment') }}">
              @error('comment')<div class="invalid-feedback">{{ $message }}</div>@enderror  
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