@extends('super/main')

@section('title', 'Add Participant')
    
@section('section-header')
<h1>Add Participant</h1>    
@endsection

@section('section-title')
    Add Participant Form
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form method="post" action="/users">
          @csrf
          <div class="form-group">
            <label for="license_id">License Number</label>
            <input type="text" class="form-control @error('license_id') is-invalid @enderror" 
             id="license_id" name="license_id" placeholder="License Number" value="{{ old('license_id')}}">
            @error('license_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
             id="name" name="name" placeholder="Name" value="{{ old('name') }}">
          @error('name') <div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control @error('password') is-invalid @enderror" 
              id="password" name="password" placeholder="Input Default Password">
            @error('password') <div class="invalid-feedback">{{ $message }}</div>@enderror      
          </div>

          <div class="form-group">
            <label for="remark">Remark</label>
            <select name="remark_id" id="remark" 
            class="form-control @error ('remark_id') is-invalid @enderror">
              <option value=""></option>
              @foreach ($remark as $remark)
              <option value="{{ $remark->id }}" {{ (old('remark_id') == $remark->id) ? 'selected' : '' }}>{{ $remark->remark }}</option>
              @endforeach
            </select>
            @error('remark_id') <div class="invalid-feedback">{{ $message }}</div>@enderror      
          </div>
          

          <button type="submit" class="btn btn-primary fas fa-plus-square"> Add Participant</button>
        </form>
      </div>
    </div>
  </div>
</div>
  


@endsection