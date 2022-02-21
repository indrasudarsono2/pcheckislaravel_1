@extends('super/main')

@section('title', 'Add Question')
    
@section('section-header')
<h1>Add ACP's Question</h1>    
@endsection

@section('section-title')
    Add ACP's Question Form
@endsection

@section('contain')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-10">
      <div class="card">
        <div card="card-body">
          <div class="table-responsive">
            <div class="card-body">
              <form method="post" action="/acp_questions">
                @csrf
                
                <div class="form-group">
                  <label for="rating">Rating</label>
                  <select name="rating_id" id="rating" 
                  class="form-control @error ('rating_id') is-invalid @enderror">
                    @foreach ($rating as $rating)
                      <option value="{{ $rating->id }}" {{ (old('rating_id') == $rating->id) ? 'selected' : '' }}>
                        {{ $rating->rating }}</option>
                    @endforeach
                  </select>
                  @error('rating_id') <div class="invalid-feedback">{{ $message }}</div>@enderror      
                </div>

                <div class="form-group">
                  <label for="group">Group</label>
                  <input type="text" id="group" name="group" class="form-control @error ('group') is-invalid @enderror" 
                  value={{ old('group') }}>
                  @error('group') <div class="invalid-feedback">{{ $message }}</div>@enderror      
                </div>
      
                <div class="form-group">
                  <label for="question">Question</label>
                  <textarea name="question" id="question" rows="50" 
                   class=" form-control @error('question') is-invalid @enderror">
                   {{ old('question') }}
                  </textarea>
                  @error('question')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                <div class="form-group">
                  <label for="a">Option A</label>
                  <textarea name="a" id="a" rows="4" 
                   class=" form-control @error('a') is-invalid @enderror" >
                   {{ old('a') }}
                  </textarea>
                  @error('a')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                <div class="form-group">
                  <label for="b">Option B</label>
                  <textarea name="b" id="b" rows="4" 
                   class=" form-control @error('b') is-invalid @enderror" >
                   {{ old('b') }}
                  </textarea>
                  @error('b')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                <div class="form-group">
                  <label for="c">Option C</label>
                  <textarea name="c" id="c" rows="4" 
                   class=" form-control @error('c') is-invalid @enderror" >
                   {{ old('c') }}
                  </textarea>
                  @error('c')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                <div class="form-group">
                  <label for="d">Option D</label>
                  <textarea name="d" id="d" rows="4" 
                   class=" form-control @error('d') is-invalid @enderror" >
                   {{ old('d') }}
                  </textarea>
                  @error('d')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                  <label for="key">Key</label>
                  <textarea name="key" id="key" rows="4" {{ old('key') }}
                   class=" form-control @error('key') is-invalid @enderror" >
                   {{ old('key') }}
                  </textarea>
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