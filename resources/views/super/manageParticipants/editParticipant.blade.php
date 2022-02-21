@extends('super/main')

@section('title', 'Edit Participant')
    
@section('section-header')
<h1>Edit Participant</h1>    
@endsection

@section('section-title')
    Edit Participant Form
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form method="post" action="/user/{{ $user->id }}">
          @method('patch')
          @csrf
          <div class="form-group">
            <label for="license_id">License Number</label>
            <input type="text" class="form-control @error('license_id') is-invalid @enderror" 
             id="license_id" name="license_id" placeholder="License Number" value="{{ $user->id }}" readonly>
            @error('license_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
             id="name" name="name" placeholder="Name" value="{{ $user->name }}">
          @error('name') <div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          
          
          <div class="form-group">
            <label for="remark">Remark</label>
            <select name="remark_id" id="remark" 
            class="form-control @error ('remark_id') is-invalid @enderror">
            @foreach ($remark as $remark)
            <option value="{{ $remark->id }}" {{ $user->remark_id == $remark->id ? 'selected' : '' }}>{{ $remark->remark }}</option>
            @endforeach
          </select>
            @error('remark_id') <div class="invalid-feedback">{{ $message }}</div>@enderror      
          </div>
          
          @if (auth()->id()==123)
              <div class="form-group">
                <label for="branch">Branch</label>
                <select name="branch_id" id="branch" 
                class="form-control @error ('branch_id') is-invalid @enderror">
                @foreach ($branch as $branch)
                <option value="{{ $branch->id }}" {{ $user->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->branch }}</option>
                @endforeach
                 </select>
                @error('branch_id') <div class="invalid-feedback">{{ $message }}</div>@enderror      
              </div>
          @endif
          <button type="submit" class="btn btn-success fas fa-edit"> Edit Participant</button>
        </form>
      </div>
    </div>
  </div>
</div>
  


@endsection