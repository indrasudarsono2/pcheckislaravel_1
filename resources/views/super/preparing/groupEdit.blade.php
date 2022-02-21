@extends('super/main')

@section('title', 'Edit Group')
    
@section('section-header')
<h1>Edit Group</h1>    
@endsection

@section('section-title')
    Edit Group Form
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form method="post" action="/groups/{{ $group->id }}">
          @csrf
          @method('patch')
          <div class="form-group">
            <label for="name">Group Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
             id="name" name="name" placeholder="" value="{{ $group->name }}">
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="form-group">
            <label for="period">Checker</label>
            <select name="checker" id="checker" 
            class="form-control @error ('checker') is-invalid @enderror">
                <option value="{{ $group->user_id }}">{{ $group->user->name }}</option>
                @foreach ($checker as $checker)
                <option value="{{ $checker->id }}" {{ (old('checker') == $checker->id) ? 'selected' : '' }}>{{ $checker->name }}</option>
                @endforeach
            </select>
            @error('checker') <div class="invalid-feedback">{{ $message }}</div>@enderror      
          </div>
          
          <button type="submit" class="btn btn-success fas fa-edit"> Edit Group</button>
        </form>
      </div>
    </div>
  </div>
</div>
  


@endsection