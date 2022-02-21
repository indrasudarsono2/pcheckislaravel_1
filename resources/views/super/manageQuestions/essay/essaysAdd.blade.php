@extends('super/main')

@section('title', 'Add Essay')
    
@section('section-header')
<h1>Add {{ $aplication_rating->rating->rating }} Essay</h1>    
@endsection

@section('section-title')
    Add Essay Form
@endsection

@section('contain')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-10">
      <div class="card">
        <div card="card-body">
          <div class="table-responsive">
            <div class="card-body">
              <form method="post" action="{{ route('aplication_ratings.essays.store', $aplication_rating) }}">
                @csrf
                <div class="form-group">
                  <label for="rating">Group</label>
                  <select name="essay_group_id" id="rating" 
                  class="form-control @error ('essay_group_id') is-invalid @enderror">
                    <option value=""></option>
                    @foreach ($essay_group as $essay_group)
                    <option value="{{ $essay_group->id }}" {{ (old('essay_group_id') == $essay_group->id) ? 'selected' : '' }}>
                      {{ $essay_group->group }}</option>
                    @endforeach
                  </select>
                  @error('essay_group_id') <div class="invalid-feedback">{{ $message }}</div>@enderror      
                </div>
                
                <div class="form-group">
                  <label for="essay">Essay</label>
                  <textarea name="essay" id="essay" 
                   class="form-control @error('essay') is-invalid @enderror" style="height: 100px">
                   {{ old('essay') }}
                  </textarea>
                  @error('essay')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                <div class="form-group">
                  <label for="answer">Answer</label>
                  <textarea name="answer" id="answer"
                   class=" form-control @error('answer') is-invalid @enderror" style="height: 100px">
                   {{ old('answer') }}
                  </textarea>
                  @error('answer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                <div class="form-group">
                  <label for="score">Score</label>
                  <input type="text" name="score" class=" form-control @error('score') is-invalid @enderror" value={{ old('score') }}>
                  @error('score')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                           
                <button type="submit" class="btn btn-primary fas fa-plus-square"> Add essay</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>

@endsection