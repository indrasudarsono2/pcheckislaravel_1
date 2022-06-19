@extends('examinee/main')

@section('title', 'Essay')

@section('section-header')
<h1>Essay</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ route('sessionss.checker_gains.form_ratings.index', [$sessionss,$checker_gain]) }}">{{ $checker_gain->gain_rating->user->name }}</a></div>
</div> 
@endsection

@section('section-title')
Rating {{ $form_rating->rating->rating }}
@endsection

@section('contain')
<div class="card">
  <div class="table-responsive">
    @if (session('alert'))
      <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="success">
            <span>×</span>
          </button>
          {{ session('alert') }}
        </div>
      </div>
    @endif
    @if (session('status'))
      <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="success">
            <span>×</span>
          </button>
          {{ session('status') }}
        </div>
      </div>
    @endif
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <td width="5px" align="center" scope="col" style="padding-left: 1px; padding-right: 1px;"><b>ID</b></td>
          <td width="100px" align="center" scope="col"><b>Essay</b></td>
          <td width="100px" align="center" scope="col"><b>Examinee Answer</b></td>
          <td width="100px" align="center" scope="col"><b>Key</b></td>
          <td width="20px" align="center" scope="col"><b>Score</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($essay_correction as $essay_correction)
        <form method="post" action="{{ route('sessionss.checker_gains.form_ratings.essay_corrections.update', [$sessionss, $checker_gain, $form_rating, $essay_correction]) }}">
          @method('patch')
          @csrf 
        <tr>
          <td width="5px" align="center" scope="col" style="padding-left: 1px; padding-right: 1px;">{{ $essay_correction->id }}</td>
          <td width="100px" align="left" scope="col" style="padding: 3px;">{{ $loop->iteration }}. {{ $essay_correction->essay->essay }}</td>
          <td width="100px" align="left" scope="col" style="padding: 3px;">{{ $essay_correction->essay_answer }}</td>
          <td width="100px" align="left" scope="col" style="padding: 3px;">{{ $essay_correction->essay->answer }}</td>
          <td width="5px" align="center" scope="col" style="padding-left: 1px; padding-right: 1px;">
            <select name="score[{{ $essay_correction->id }}]" class="form-control @error ('score') is-invalid @enderror" style="width: 80px">
              <option value=""></option>
              @for($i=1 ; $i<=$essay_correction->essay->score;$i++)
              <option value="{{ $i }}">{{ $i }}</option>
              @endfor
            </select>
          </td>
        </tr>
        @endforeach
          <tr>
            <td colspan="4"></td>
            <td width="5px" align="center" scope="col" style="padding-left: 1px; padding-right: 1px;">
              <button type="submit" class="btn btn-success fas fa-edit" id="essay" onclick="return confirm('Are you sure want to submit it?')"> Submit</button></td>
          </tr>
        </form>
      </tbody>
    </table>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript"> 
$(document).ready(function(){
  $('#essay').click(function(){
    $('#essay').hide()
  });
});
</script>
@endsection