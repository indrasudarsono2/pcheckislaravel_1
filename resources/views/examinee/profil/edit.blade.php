@extends('examinee/main')

@section('title', 'Profil')
    
@section('section-header')
<h1>Profil</h1>    
@endsection

@section('section-title')
    Edit
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form action="/profil/{{ $biodata->id }}" method="post">
          @method('patch')
          @csrf
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label"><font size="3px">Nama</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('name') is-invalid @enderror" 
              name="name" placeholder="name" value="{{ Auth::user()->name }}">
              @error('name') <div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="alamat" class="col-sm-2 col-form-label"><font size="3px">Alamat</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('alamat') is-invalid @enderror" 
              id="address" name="alamat" placeholder="Alamat" value="{{ $biodata->address_user }}">
              <span id="count"></span> karakter tersisa
              @error('alamat') <div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="tempat_lahir" class="col-sm-2 col-form-label"><font size="3px">Tempat Lahir</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error ('tempat_lahir') is-invalid @enderror" 
              id="tempat_lahir" name="tempat_lahir" value="{{ $biodata->place_of_birth }}">
              @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror  
            </div>
          </div>

          <div class="form-group row">
            <label for="tanggal_lahir" class="col-sm-2 col-form-label"><font size="3px">Tanggal Lahir</font></label>
            <div class="col-sm-10">
              <input type="date" name="tanggal_lahir" class="form-control @error ('tanggal_lahir') is-invalid @enderror" value="{{ $biodata->date_of_birth->format('Y-m-d') }}" id="tanggal_lahir">
              @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror  
            </div>
          </div>

          <div class="form-group row">
            <label for="rambut" class="col-sm-2 col-form-label"><font size="3px">Rambut</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error ('rambut') is-invalid @enderror" 
              id="rambut" name="rambut" value="{{ $biodata->hair }}">
              @error('rambut')<div class="invalid-feedback">{{ $message }}</div>@enderror  
            </div>
          </div>
          
          <div class="form-group row">
            <label for="mata" class="col-sm-2 col-form-label"><font size="3px">Mata</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error ('mata') is-invalid @enderror" 
              id="mata" name="mata" value="{{ $biodata->eyes }}">
              @error('mata')<div class="invalid-feedback">{{ $message }}</div>@enderror  
            </div>
          </div>

          <fieldset class="form-group">
            <div class="row">
              <label class="col-form-label col-sm-2 pt-0"><font size="3px" color="black">Jenis Kelamin</font></label>
              <div class="col-sm-10">
                @foreach ($gender as $gender)
                <div class="form-check form-check-inline">
                  <input class="form-check-input  @error ('gender_id') is-invalid @enderror" type="radio" name="gender_id" id="1" value="{{$gender->id}}"
                  {{ $biodata->gender_id == $gender->id ? 'checked' : '' }}>
                  <label class="form-check-label" for="1">
                    {{$gender->gender}}
                  </label>
                </div>    
                @endforeach
              </div>
            </div>
          </fieldset>
                
        <div class="form-group row">
          <label for="kebangsaan" class="col-sm-2 col-form-label"><font size="3px">Kebangsaan</font></label>
          <div class="col-sm-10">
            <input type="text" class="form-control @error ('kebangsaan') is-invalid @enderror" 
            id="kebangsaan" name="kebangsaan" value="{{ $biodata->nationality }}">
            @error('kebangsaan')<div class="invalid-feedback">{{ $message }}</div>@enderror  
          </div>
        </div>

        <div class="form-group row">
          <label for="height" class="col-sm-2 col-form-label"><font size="3px">Tinggi</font></label>
          <div class="col-sm-10">
            <input type="text" class="form-control @error ('height') is-invalid @enderror" 
            id="height" name="height" value="{{ $biodata->height }}">
            @error('height')<div class="invalid-feedback">{{ $message }}</div>@enderror  
          </div>
        </div>

        <div class="form-group row">
          <label for="weight" class="col-sm-2 col-form-label"><font size="3px">Berat</font></label>
          <div class="col-sm-10">
            <input type="text" class="form-control @error ('weight') is-invalid @enderror" 
            id="weight" name="weight" value="{{ $biodata->weight }}">
            @error('weight')<div class="invalid-feedback">{{ $message }}</div>@enderror  
          </div>
        </div>

        <div class="form-group row">
          <label for="email" class="col-sm-2 col-form-label"><font size="3px">Email</font></label>
          <div class="col-sm-10">
            <input type="email" class="form-control @error ('email') is-invalid @enderror" 
            id="email" name="email" value="{{ Auth::user()->email }}">
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror  
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