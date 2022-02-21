@extends('super/main')

@section('title', 'Add Question')
    
@section('section-header')
<h1>Add {{ $aplication_rating->rating->rating }}'s Question</h1>    
@endsection

@section('section-title')
    Add {{ $aplication_rating->rating->rating }}'s Question Form
@endsection

@section('contain')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-10">
      <div class="card">
        <div card="card-body">
          <div class="table-responsive">
            <div class="card-body">
              <form method="post" action="{{ route('aplication_ratings.mc_questions.store', $aplication_rating) }}">
                @csrf
                <div class="form-group">
                  <label for="group_id">Group</label>
                  <select name="group_id" id="group_id" class="form-control @error ('group_id') is-invalid @enderror">
                    <option value=""></option>
                    @foreach ($group as $group)
                    <option value="{{ $group->id }}" {{ (old('group_id') == $group->id) ? 'selected' : '' }}>{{ $group->group }}</option>
                    @endforeach
                  </select>
                  @error('group_id') <div class="invalid-feedback">{{ $message }}</div>@enderror      
                </div>
      
                <div class="form-group">
                  <label for="question">Question</label>
                  <textarea name="question" id="question" 
                   class="form-control @error('question') is-invalid @enderror" style="height: 100px">
                   {{ old('question') }}
                  </textarea>
                  @error('question')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                <div class="form-group">
                  <label for="a">Option A</label>
                  <textarea name="a" id="a"
                   class=" form-control @error('a') is-invalid @enderror" style="height: 100px">
                   {{ old('a') }}
                  </textarea>
                  @error('a')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                <div class="form-group">
                  <label for="b">Option B</label>
                  <textarea name="b" id="b"
                   class=" form-control @error('b') is-invalid @enderror" style="height: 100px">
                   {{ old('b') }}
                  </textarea>
                  @error('b')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                <div class="form-group">
                  <label for="c">Option C</label>
                  <textarea name="c" id="c"
                   class=" form-control @error('c') is-invalid @enderror" style="height: 100px">
                   {{ old('c') }}
                  </textarea>
                  @error('c')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                <div class="form-group">
                  <label for="d">Option D</label>
                  <textarea name="d" id="d"
                   class=" form-control @error('d') is-invalid @enderror" style="height: 100px">
                   {{ old('d') }}
                  </textarea>
                  @error('d')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                  <label for="key">Key</label>
                  <input type="text" name="key" class=" form-control @error('key') is-invalid @enderror" value={{ old('key') }}>
                  @error('key')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                           
                <button type="submit" class="btn btn-primary fas fa-plus-square"> Add question</button>
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