@extends('examinee/main')

@section('title', 'Profil')

@section('section-header')
<h1>Profil</h1>
@endsection

@section('section-title')
Hi, {{ Auth::user()->name }}    
@endsection

@section('contain')
<div class="row mt-sm-4">
  <div class="col-12 col-md-12 col-lg-8">
    <form action="/profil" method="post">
      @csrf
    <div class="card profile-widget">
      <div class="profile-widget-header">
        @if ($biodata==null)
        <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-1.png') }}" class="rounded-circle profile-widget-picture">
        @endif
        @if ($biodata!=null)
          @if ($biodata->gender_id==1)
          <img alt="image" src="{{ asset('stisla/assets/img/avatar/male.jpg') }}" class="rounded-circle profile-widget-picture">
          @endif
          @if ($biodata->gender_id==2)
          <img alt="image" src="{{ asset('stisla/assets/img/avatar/female.png') }}" class="rounded-circle profile-widget-picture">
          @endif
        @endif
        <div class="profile-widget-items">
          <div class="profile-widget-item">
            <div class="profile-widget-item-label"><font size="3px">Nomor License</font></div>
              <div class="profile-widget-item-value">{{ Auth::id() }}</div>
          </div>
          <div class="profile-widget-item">
            <div class="profile-widget-item-label"><font size="3px">Tinggi</font></div>
            @if ($biodata!=null)
              <div class="profile-widget-item-value">{{ $biodata->height }} cm</div>
            @endif
            @if ($biodata==null)
            <div class="profile-widget-item-value">
              <input type="text" class="form-control mx-auto @error('height') is-invalid @enderror" 
             name="height" placeholder="cm" style="width: 85px;" value="{{ old('height') }}"></div>
            @endif
          </div>
          <div class="profile-widget-item">
            <div class="profile-widget-item-label"><font size="3px">Berat</font></div>
            @if ($biodata!=null)
              <div class="profile-widget-item-value">{{ $biodata->weight }} kg</div>
            @endif
            @if ($biodata==null)
            <div class="profile-widget-item-value">
              <input type="text" class="form-control mx-auto @error('weight') is-invalid @enderror" 
              name="weight" placeholder="kg" style="width: 85px;" value="{{ old('weight') }}"></div>
            @endif
          </div>
        </div>
      </div>
      @if (session('status'))
      <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="success">
            <span>×</span>
          </button>
          {{ session('status') }}
        </div>
      </div>
      @endif
      <div class="profile-widget-description">
        <div class="profile-widget-name">{{Auth::user()->name}}</div>
        
        <div class="form-group row">
          <label for="alamat" class="col-sm-2 col-form-label"><font size="3px">Alamat</font></label>
          <div class="col-sm-10 mt-1">
            @if ($biodata!=null)
            <span class="form-text">
              <font size="3px" style="color: black">
                {{ $biodata->address_user }}
              </font>
            </span>
            @endif
            @if ($biodata==null)
              <input type="text" class="form-control @error('alamat') is-invalid @enderror" 
              id="address" name="alamat" placeholder="Alamat" value="{{ old('alamat') }}">
              <span id="count"></span> karakter tersisa
              @error('alamat') <div class="invalid-feedback">{{ $message }}</div>@enderror
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="tempat_lahir" class="col-sm-2 col-form-label"><font size="3px">Tempat Lahir</font></label>
          <div class="col-sm-10 mt-1">
            @if ($biodata!=null)
            <span class="form-text">
              <font size="3px" style="color: black">
                  {{ $biodata->place_of_birth }}
                </font>
              </span>
            @endif
            @if ($biodata==null)
              <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" 
              id="tempat_lahir" name="tempat_lahir" placeholder="Tempat lahir" value="{{ old('tempat_lahir') }}">
              @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div>@enderror
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="tanggal_lahir" class="col-sm-2 col-form-label"><font size="3px">Tanggal Lahir</font></label>
          <div class="col-sm-10 mt-1">
            @if ($biodata!=null)
            <span class="form-text">
              <font size="3px" style="color: black">
                  {{ $biodata->date_of_birth->format('d F Y') }}
                </font>
              </span>
            @endif
            @if ($biodata==null)
              <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
              id="tanggal_lahir" name="tanggal_lahir" placeholder="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
            @endif
            @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>
        <div class="form-group row">
          <label for="rambut" class="col-sm-2 col-form-label"><font size="3px">Rambut</font></label>
          <div class="col-sm-10 mt-1">
            @if ($biodata!=null)
            <span class="form-text">
              <font size="3px" style="color: black">
                  {{ $biodata->hair }}
                </font>
              </span>
            @endif
            @if ($biodata==null)
              <input type="text" class="form-control @error('rambut') is-invalid @enderror" 
              id="rambut" name="rambut" placeholder="Warna rambut" value="{{ old('rambut') }}">
            @endif
            @error('rambut') <div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>
        <div class="form-group row">
          <label for="mata" class="col-sm-2 col-form-label"><font size="3px">Mata</font></label>
          <div class="col-sm-10 mt-1">
            @if ($biodata!=null)
            <span class="form-text">
              <font size="3px" style="color: black">
                  {{ $biodata->eyes }}
                </font>
              </span>
            @endif
            @if ($biodata==null)
              <input type="text" class="form-control @error('mata') is-invalid @enderror" 
              id="mata" name="mata" placeholder="Warna mata" value="{{ old('mata') }}">
            @endif
            @error('mata') <div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>
        <div class="form-group row">
          <label for="jenis_kelamin" class="col-sm-2 col-form-label"><font size="3px">Jenis Kelamin</font></label>
          <div class="col-sm-10 mt-1">
            @if ($biodata!=null)
            <span class="form-text">
              <font size="3px" style="color: black">
                  {{ $biodata->gender->gender }}
              </font>
            </span>
            @endif
            @if ($biodata==null)
            @foreach ($gender as $gender)
            <div class="form-check form-check-inline">
              <input class="form-check-input  @error ('gender_id') is-invalid @enderror" type="radio" name="gender_id" value="{{$gender->id}}"
              {{ (old('gender_id') == $gender->id) ? 'checked' : '' }}>
              <label class="form-check-label">
                {{$gender->gender}}
              </label>
            </div>    
            @endforeach
            @endif
          </div>
          @error('gender_id') <div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group row">
          <label for="kebangsaan" class="col-sm-2 col-form-label"><font size="3px">Kebangsaan</font></label>
          <div class="col-sm-10 mt-1">
            @if ($biodata!=null)
            <span class="form-text">
              <font size="3px" style="color: black">
                {{ $biodata->nationality }}
              </font>
            </span>
            @endif
            @if ($biodata==null)
              <input type="text" class="form-control @error('kebangsaan') is-invalid @enderror" 
              id="kebangsaan" name="kebangsaan" placeholder="Kebangsaan" value="{{ old('kebangsaan') }}">
            @endif
            @error('kebangsaan') <div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="email" class="col-sm-2 col-form-label"><font size="3px">Email</font></label>
          <div class="col-sm-10 mt-1">
            @if (Auth::user()->email != null)
            <span class="form-text">
              <font size="3px" style="color: black">
                {{ Auth::user()->email }}
              </font>
            </span>
            @endif
            @if (Auth::user()->email == null)
              <input type="email" class="form-control @error('email') is-invalid @enderror" 
              id="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @endif
            @error('email') <div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>
        
        @if ($biodata==null)
          <button type="submit" class="btn btn-primary far fa-save" id="create"> Simpan</button>
        @endif
        @if ($biodata!=null)
          <a href="/profil/{{$biodata->id}}/edit" class="btn btn-success fas fa-edit"> Edit</a> 
        @endif
      </div>
    </div>
    </form>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/length.js') }}"></script>
@endsection