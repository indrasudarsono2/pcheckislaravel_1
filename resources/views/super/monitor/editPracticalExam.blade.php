@extends('super/main')

@section('title', 'Practical Exam')

@section('section-header')
<h1>Edit Practical Exam for {{ $form_rating->aplication_file->user->name }}</h1> 
@endsection

@section('section-title')
Rating {{ $aplication_rating->rating->rating }}  
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form method="post" action="{{ route('updatePracticalExam', [$session, $remark_ap_file, $aplication_rating, $form_rating]) }}">
          @method('patch')
          @csrf
          @for($i = 0 ; $i < count($practical_exam) ; $i++)
            <div class="container mb-2" style="border: solid 1px black; border-radius: 15px">
              <div class="form-group">
                <label for="id">Score ID</label>
                <input type="text" class="form-control @error('id') is-invalid @enderror" 
                id="id" name="{{ $practical_exam[$i]->id }}" placeholder="License Number" value="{{ $practical_exam[$i]->id }}" readonly>
                @error('id')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="form-group">
                <label for="checker_id">Checker Name</label>
                <input type="text" class="form-control @error('checker_id') is-invalid @enderror" 
                id="checker_id" name="checker_id" placeholder="License Number" value="{{ $practical_exam[$i]->user->name }}" readonly>
                @error('checker_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="form-group">
                  <label for="score">Practical Exam`s Score</label>
                  <input type="text" class="form-control @error('score') is-invalid @enderror" 
                  id="score" name="score[{{ $practical_exam[$i]->id }}]" placeholder="score" value="{{ $practical_exam[$i]->score }}">
              @error('score') <div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>
          @endfor
            <div class="container">
              <button type="submit" class="btn btn-success fas fa-edit"> Edit Practical Exam</button>
            </div>      
          </form>

      </div>
    </div>
  </div>
</div>
@endsection