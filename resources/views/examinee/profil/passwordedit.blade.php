@extends('examinee/main')

@section('title', 'Edit Password')
    
@section('section-header')
<h1>Edit Password</h1>    
@endsection

@section('section-title')
  Edit
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
        <form action="/passwordusr_update" method="post">
          @method('patch')
          @csrf
          <div class="form-group row">
            <label for="new_password" class="col-sm-2 col-form-label"><font size="3px">Password baru</font></label>
            <div class="col-sm-10">
              <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
              name="new_password" placeholder="Masukkan password yang baru">
              @error('new_password') <div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="conf_password" class="col-sm-2 col-form-label"><font size="3px">Konfirmasi Password</font></label>
            <div class="col-sm-10">
              <input type="password" class="form-control @error('conf_password') is-invalid @enderror" 
              name="conf_password" placeholder="Ketik ulang password baru">
              @error('conf_password') <div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

        <button type="submit" class="btn btn-success fas fa-edit"> Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection