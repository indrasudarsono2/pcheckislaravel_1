@extends('super/main')

@section('title', 'Edit Member')
    
@section('section-header')
<h1>Edit Member</h1>    
@endsection

@section('section-title')
    Edit Member Form
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form method="post" action="/groups/{{ $group->id }}/group_members/{{ $group_member->id }}">
          @csrf
          @method('patch')
          <div class="form-group">
            <label for="name">Group Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
             id="name" name="name" placeholder="" value="{{ $group->name }}" readonly>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="form-group">
            <label for="period">Member</label>
            <select name="member" id="member" 
            class="form-control @error ('member') is-invalid @enderror">
                <option value="{{ $group_member->user_id }}">{{ $group_member->user->name }}</option>
                @foreach ($member as $member)
                <option value="{{ $member->id }}" {{ (old('member') == $member->id) ? 'selected' : '' }}>{{ $member->name }}</option>
                @endforeach
            </select>
            @error('member') <div class="invalid-feedback">{{ $message }}</div>@enderror      
          </div>
          
          <button type="submit" class="btn btn-success fas fa-edit"> Edit Member</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection