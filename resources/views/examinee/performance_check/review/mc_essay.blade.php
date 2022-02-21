@extends('examinee/main')

@section('title', 'Review')

@section('section-header')
<h1>Review</h1>
@endsection

@section('section-title')
@if($mc_score>=70)
  <h1 style="color: green">Score = {{ $mc_score }}</h1>
@else
  <h1 style="color: red">Score = {{ $mc_score }}</h1>
@endif  
@endsection

@section('contain')
<div class="card">
  <div class="table-responsive">
    <h2>Multiple Choice</h2>
    @for ($i = 0; $i < $false; $i++)
      <table style="border: 0px">
        <tr>
          <td width="40px" valign="top" style="border: 0px">{{ $no++ }}.</td>
          <td width="1250px" style="border: 0px">{{ $review[$i][0]->question }}</td>
        </tr>
        <tr>
          <td width="40px" valign="top" style="border: 0px"><input type="text" name="mc_question_id[]" value="{{ $review[$i][0]->id }}" hidden></td>
          <td width="1250px" style="border: 0px">
            <div class="form-check form-check-inline">
              @if ($option[$i][0]=="A")
                <label class="form-check-label" for="1" style="color: red">
                  A. {{ $review[$i][0]->a }}
                </label>
              @else
                <label class="form-check-label" for="1">
                  A. {{ $review[$i][0]->a }}
                </label>
              @endif
            </div>
          </td>
        </tr>
        <tr>
          <td width="40px" valign="top" style="border: 0px"><input type="text" name="mc_question_id[]" value="{{ $review[$i][0]->id }}" hidden></td>
          <td width="1250px" style="border: 0px">
            <div class="form-check form-check-inline">
              @if($option[$i][0]=="B")
                <label class="form-check-label" for="1" style="color: red">
                  B. {{ $review[$i][0]->b }}
                </label>
              @else
                <label class="form-check-label" for="1">
                  B. {{ $review[$i][0]->b }}
                </label>
              @endif
            </div>
          </td>
        </tr>
        <tr>
          <td width="40px" valign="top" style="border: 0px"><input type="text" name="mc_question_id[]" value="{{ $review[$i][0]->id }}" hidden></td>
          <td width="1250px" style="border: 0px">
            <div class="form-check form-check-inline">
              @if($option[$i][0]=="C")
                <label class="form-check-label" for="1" style="color: red">
                  C. {{ $review[$i][0]->c }}
                </label>
              @else
                <label class="form-check-label" for="1" >
                  C. {{ $review[$i][0]->c }}
                </label>
              @endif
            </div>
          </td>
        </tr>
        <tr>
          <td width="40px" valign="top" style="border: 0px"><input type="text" name="mc_question_id[]" value="{{ $review[$i][0]->id }}" hidden></td>
          <td width="1250px" style="border: 0px">
            <div class="form-check form-check-inline">
              @if($option[$i][0]=="D")
                <label class="form-check-label" for="1" style="color: red">
                  D. {{ $review[$i][0]->d }}
                </label>
              @else
                <label class="form-check-label" for="1">
                  D. {{ $review[$i][0]->d }}
                </label>
              @endif
            </div>
          </td>
        </tr>
      </table>
    @endfor
    <br/>
    <h2>Essay</h2>
    <table style="border: 0px">
      @foreach ($essay as $essay)
        <tr>
          <td width="40px" valign="top" style="border: 0px">{{ $loop->iteration }}.</td>
          <td width="1250px" style="border: 0px">{{ $essay->essay->essay }}</td>
        </tr>
        <tr>
          <td width="40px" valign="top" style="border: 0px"></td>
          <td width="1250px" style="border: 0px"><b>{{ $essay->checker->name }}</b> : {{ $essay->essay_score }}</td>
        </tr>
      @endforeach
    </table>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/countdown.js') }}"></script>

<script type="text/javascript">
  function disableSelection(e){if(typeof e.onselectstart!="undefined")e.onselectstart=function(){return false};else if(typeof e.style.MozUserSelect!="undefined")
  e.style.MozUserSelect="none";else e.onmousedown=function(){return false};e.style.cursor="default"}window.onload=function(){disableSelection(document.body)}

  function mousedwn(e){try{if(event.button==2||event.button==3)return false}catch(e){if(e.which==3)return false}}document.oncontextmenu=function(){return false};document.ondragstart=function(){return false};document.onmousedown=mousedwn

  window.addEventListener("keydown",function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){e.preventDefault()}});document.keypress=function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){}return false}

  document.onkeydown=function(e){e=e||window.event;if(e.keyCode==123||e.keyCode==18){return false}}

</script>
@endsection