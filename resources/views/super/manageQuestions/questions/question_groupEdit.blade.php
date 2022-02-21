@extends('super/main')

@section('title', 'Edit Group')
    
@section('section-header')
<h1>Edit {{ $aplication_rating->rating->rating }}'s Group</h1>    
@endsection

@section('section-title')
    Edit {{ $aplication_rating->rating->rating }}'s Group Form
@endsection

@section('contain')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-10">
      <div class="card">
        <div card="card-body">
          <div class="table-responsive">
            <div class="card-body">
              <form method="post" action="{{ route('aplication_ratings.question_groups.update', [$aplication_rating, $question_group]) }}">
                @method('patch')
                @csrf
                <div class="form-group">
                  <label for="group">Group</label>
                  <input type="text" class="form-control @error('group') is-invalid @enderror" 
                   id="group" name="group" placeholder="" value="{{ $question_group->group }}">
                  @error('group')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                  <label for="quantity">Quantity</label>
                  <input type="text" id="quantity" name="quantity" class="form-control @error ('quantity') is-invalid @enderror" 
                  value={{ $question_group->quantity }}>
                  @error('quantity') <div class="invalid-feedback">{{ $message }}</div>@enderror      
                </div>
                <button type="submit" class="btn btn-success fas fa-edit"> Edit Group</button>  
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