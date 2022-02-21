@extends('super/main')

@section('title', 'Edit Password')
    
@section('section-header')
<h1>Password Confirmation</h1>    
@endsection

@section('section-title')
    Confirmation
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    @if (session('alert'))
      <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="success">
            <span>×</span>
          </button>
          {{ session('alert') }}
        </div>
      </div>
    @endif
    <div class="table-responsive">
      <div class="card-body">
        <form action="/password_confirmation" method="post">
          @csrf
          <div class="form-group row">
            <label for="old_password" class="col-sm-2 col-form-label"><font size="3px">Password Lama</font></label>
            <div class="col-sm-10">
              <input type="password" class="form-control @error('old_password') is-invalid @enderror" 
              name="old_password" placeholder="Masukkan password saat ini">
              @error('old_password') <div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

        <button type="submit" class="btn btn-primary fas fa-edit"> Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection