@extends('super/main')

@section('title', 'Edit Question')
    
@section('section-header')
<h1>Edit ACP's Question</h1>    
@endsection

@section('section-title')
    Edit ACP's Question Form
@endsection

@section('contain')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-10">
      <div class="card">
        <div card="card-body">
          <div class="table-responsive">
            <div class="card-body">
            <form method="post" action="/acp_questions/{{ $acp_question->id }}">
              @method('patch')  
              @csrf
                
              <div class="form-group">
                <label for="rating">Rating</label>
                <select name="rating_id" id="rating" 
                class="form-control @error ('rating_id') is-invalid @enderror">
                  @foreach ($rating as $rating)
                    <option value="{{ $rating->id }}">
                      {{ $rating->rating }}</option>
                  @endforeach
                </select>
                @error('rating_id') <div class="invalid-feedback">{{ $message }}</div>@enderror      
              </div>

                <div class="form-group">
                  <label for="group">Group</label>
                  <input type="text" id="group" name="group" class="form-control @error ('group') is-invalid @enderror" 
                  value={{ $acp_question->group }}>
                  @error('group') <div class="invalid-feedback">{{ $message }}</div>@enderror      
                </div>
      
                <div class="form-group">
                  <label for="question">Question</label>
                  <textarea name="question" id="question" rows="50" 
                   class=" form-control @error('question') is-invalid @enderror">
                   {{ $acp_question->question }}
                  </textarea>
                  @error('question')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                <div class="form-group">
                  <label for="a">Option A</label>
                  <textarea name="a" id="a" rows="4" 
                   class=" form-control @error('a') is-invalid @enderror" >
                   {{ $acp_question->a }}
                  </textarea>
                  @error('a')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                <div class="form-group">
                  <label for="b">Option B</label>
                  <textarea name="b" id="b" rows="4" 
                   class=" form-control @error('b') is-invalid @enderror" >
                   {{ $acp_question->b }}
                  </textarea>
                  @error('b')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                <div class="form-group">
                  <label for="c">Option C</label>
                  <textarea name="c" id="c" rows="4" 
                   class=" form-control @error('c') is-invalid @enderror" >
                   {{ $acp_question->c }}
                  </textarea>
                  @error('c')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                <div class="form-group">
                  <label for="d">Option D</label>
                  <textarea name="d" id="d" rows="4" 
                   class=" form-control @error('d') is-invalid @enderror" >
                   {{ $acp_question->d }}
                  </textarea>
                  @error('d')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                  <label for="key">Key</label>
                  <input type="text" id="key" name="key" class="form-control @error ('key') is-invalid @enderror" 
                  value={{ $acp_question->key }}>
                  @error('key')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
      
                      
                <button type="submit" class="btn btn-success fas fa-edit"> Edit</button>
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