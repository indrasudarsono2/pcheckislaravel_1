@extends('examinee/main')

@section('title', 'Performance Check')

@section('section-header')
<h1>Check Acs's Rating</h1>
@endsection

@section('section-title')
Acs's Rating
@endsection

@section('contain')
<div class="card">
  <div class="table-responsive">
    <div class="text-center">
      <center><font size="8px"><b>WELCOME TO</b></font></center>
      <center><font size="7px">PERFORMANCE CHECK ACS'S RATING</font></center>
      <center><font size="6px">Before You Get Started</font></center>
      <center><font size="6px">Please Fill The Field Below</font></center>
      <div class="container">
        <div class="row">
          <div class="col-4">
          </div>
            <div class="col-4">
              <form action="acs_check" method="post">
                @csrf
                <div class="form-group">
                <input type="text" class="form-control @error('question_code') is-invalid @enderror" 
                 id="question_code" name="question_code" placeholder="Input Question Code">
                @error('question_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                  <input type="text" class="form-control @error('question_code') is-invalid @enderror" 
                   id="question_code" name="question_code" placeholder="Input Aplication File ID">
                  @error('question_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
              <button type="submit" class="btn btn-dark fas fa-chess-queen"> Click</button>
             
              </form> 
            </div>
            
          
        </div>
      </div>
      
   
      
    </div>
  </div>
</div>

@endsection