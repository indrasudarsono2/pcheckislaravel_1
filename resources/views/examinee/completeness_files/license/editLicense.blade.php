@extends('examinee/main')

@section('title', 'License')
    
@section('section-header')
<h1>Edit license's Data</h1>    
@endsection

@section('section-title')
    Datas
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form action="{{ route('licenses.update', $license->id) }}" method="post" enctype="multipart/form-data">
          @method('put')
          @csrf
          <div class="form-group row">
            <label for="license_file" class="col-sm-2 col-form-label"><font size="3px">License`s File</font></label>
            <div class="col-sm-10">
              <input type="file" class="form-control @error ('license_file') is-invalid @enderror" 
              id="license_file" name="license_file">
              @error('license_file')<div class="invalid-feedback">{{ $message }}</div>@enderror  
            </div>
            <iframe src="{{ Storage::url($license->fileUrl) }}" frameborder="0" style="width: 100%; height: 500px"></iframe>
          </div>

          <div class="form-group row">
            <label for="comment" class="col-sm-2 col-form-label"><font size="3px">Comment</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error ('comment') is-invalid @enderror" 
              id="comment" name="comment" value="{{ $license->comment }}">
              @error('comment')<div class="invalid-feedback">{{ $message }}</div>@enderror  
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