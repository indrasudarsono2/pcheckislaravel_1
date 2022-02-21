@extends('super/main')

@section('title', 'Edit Essay')
    
@section('section-header')
<h1>Edit {{ $aplication_rating->rating->rating }} Essay</h1>    
@endsection

@section('section-title')
    Edit Essay Form
@endsection

@section('contain')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-10">
      <div class="card">
        <div card="card-body">
          <div class="table-responsive">
            <div class="card-body">
              <form method="post" action="{{ route('aplication_ratings.essays.update', [$aplication_rating, $essay]) }}">
                @method('patch')
                @csrf
                <div class="form-group">
                  <label for="rating">Group</label>
                  <select name="essay_group_id" id="rating" 
                  class="form-control @error ('essay_group_id') is-invalid @enderror">
                    <option value=""></option>
                    @foreach ($essay_group as $essay_group)
                    <option value="{{ $essay_group->id }}" {{ ($essay->essay_group_id == $essay_group->id) ? 'selected' : '' }}>
                      {{ $essay_group->group }}</option>
                    @endforeach
                  </select>
                  @error('essay_group_id') <div class="invalid-feedback">{{ $message }}</div>@enderror      
                </div>

                <div class="form-group">
                  <label for="essay">Essay</label>
                  <textarea name="essay" id="essay" 
                   class="form-control @error('essay') is-invalid @enderror" style="height: 100px">
                   {{ $essay->essay }}
                  </textarea>
                  @error('essay')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                <div class="form-group">
                  <label for="answer">Answer</label>
                  <textarea name="answer" id="answer"
                   class=" form-control @error('answer') is-invalid @enderror" style="height: 100px">
                   {{ $essay->answer }}
                  </textarea>
                  @error('answer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                <div class="form-group">
                  <label for="score">Score</label>
                  <input type="text" name="score" class=" form-control @error('score') is-invalid @enderror" value={{ $essay->score }}>
                  @error('score')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                           
                <button type="submit" class="btn btn-success fas fa-edit"> Edit essay</button>
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