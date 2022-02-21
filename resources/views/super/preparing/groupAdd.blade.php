@extends('super/main')

@section('title', 'Add Group')
    
@section('section-header')
<h1>Add Group</h1>    
@endsection

@section('section-title')
    Add Group Form
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form method="post" action="/groupss">
          @csrf

          <div class="form-group">
            <label for="name">Group Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
             id="name" name="name" placeholder="" value="{{ old('name') }}">
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="form-group">
            <label for="period">Checker</label>
            <select name="checker" id="checker" 
            class="form-control @error ('checker') is-invalid @enderror">
                <option value=""></option>
                @foreach ($checker as $checker)
                <option value="{{ $checker->id }}" {{ (old('checker') == $checker->id) ? 'selected' : '' }}>{{ $checker->name }}</option>
                @endforeach
            </select>
            @error('checker') <div class="invalid-feedback">{{ $message }}</div>@enderror      
          </div>
          
          <button type="submit" class="btn btn-primary fas fa-plus-square"> Add Group</button>
        </form>
      </div>
    </div>
  </div>
</div>
  


@endsection