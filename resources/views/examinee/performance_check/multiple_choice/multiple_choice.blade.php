@extends('examinee/main')

@section('title', 'Multiple choice`s Question')
    
@section('section-header')
<h1>{{ $performance_check->question_varian->varian }}`s Question</h1>    
@endsection

@section('section-title')
    Question
@endsection

@section('contain')
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>

<center><div data-countdown="03/03/2021"></div></center>        
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      {{-- <div id='timer'><h1 align="center">sisawaktu<br/>jam menit second </h1><hr></div> --}}
      <div id='timer'></div>
      <div class="progress">
				<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
      <div class="card-body">
        <form method="post" id="mc_question" name="frmupload" action="{{ route('form_ratings.performance_checks.question_varians.store', [$form_rating, $performance_check]) }}">
          @csrf
          
          <div class="table-responsive">
            @for ($i=0; $i<$count; $i++)
              <fieldset>
                @for ($j=0; $j<$question_group_quantity[$i]; $j++)
                  <table style="border: 0px" class="radio">
                    <tr>
                      <td width="40px" valign="top" style="border: 0px"><span style="color:grey">{{ $no++ }}.</span></td>
                      <td width="1250px" style="border: 0px">{{ $mc_question[$i][$j]->question }}</td>
                    </tr>
                    <tr>
                      <td width="40px" valign="top" style="border: 0px"><input type="text" name="mc_question_id[]" value="{{ $mc_question[$i][$j]->id }}" hidden></td>
                      <td width="1250px" style="border: 0px">
                        <div class="form-check form-check-inline">
                          <input type="radio" class="form-check-input" name="option[{{ $mc_question[$i][$j]->id }}]" value="A"> 
                          <label class="form-check-label" for="1">
                            {{ $mc_question[$i][$j]->a }}
                          </label>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="40px" valign="top" style="border: 0px"></td>
                      <td width="1250px" style="border: 0px">
                        <div class="form-check form-check-inline">
                          <input type="radio" class="form-check-input" name="option[{{ $mc_question[$i][$j]->id }}]" value="B"> 
                          <label class="form-check-label" for="1">
                            {{ $mc_question[$i][$j]->b }}
                          </label>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="40px" valign="top" style="border: 0px"></td>
                      <td width="1250px" style="border: 0px">
                        <div class="form-check form-check-inline">
                          <input type="radio" class="form-check-input" name="option[{{ $mc_question[$i][$j]->id }}]" value="C"> 
                          <label class="form-check-label" for="1">
                            {{ $mc_question[$i][$j]->c }}
                          </label>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="40px" valign="top" style="border: 0px"></td>
                      <td width="1250px" style="border: 0px">
                        <div class="form-check form-check-inline">
                          <input type="radio" class="form-check-input" name="option[{{ $mc_question[$i][$j]->id }}]" value="D"> 
                          <label class="form-check-label" for="1">
                            {{ $mc_question[$i][$j]->d }}
                          </label>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="40px" valign="top" style="border: 0px"></td>
                      <td width="1250px" style="border: 0px">
                        <div class="form-check form-check-inline">
                          <input type="radio" class="form-check-input" id="option_id[{{ $mc_question[$i][$j]->id }}]" name="option[{{ $mc_question[$i][$j]->id }}]" value="NN" checked> 
                          <label class="form-check-label" for="1">
                            Belum memilih jawaban
                          </label>
                        </div>
                      </td>
                    </tr>
                  </table>
                @endfor
                @if($count<=1)
                  <button type="submit" class="btn btn-success fas fa-shipping-fast" id="finish"> Finish</button>
                @else
                  @if ($i==0)
                    <input type="button" name="next" class="next btn btn-info" value="Next" />
                  @endif    
                  @if ($i==($count-1))
                    <input type="button" name="previous" class="previous btn btn-primary" value="Previous"/>
                    <button type="submit" class="btn btn-success fas fa-shipping-fast" id="finish"> Finish</button>
                  @endif  
                  @if ($i!=($count-1) && $i!=0) 
                    <input type="button" name="previous" class="previous btn btn-primary" value="Previous" />
                    <input type="button" name="next" class="next btn btn-info" value="Next" />
                  @endif
                @endif
                
              </fieldset> 
            @endfor
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function () {
    var second = 0;
    var minute = "<?php echo $minute; ?>";
    var hour = "<?php echo $hour; ?>";
    
    interval();
    finish();
        
    function interval(){
      var x = setInterval(function(){
        if(minute<10 && hour==0){
        var alertt = 'style="color:red"'
        }
        
        $('#timer').html('<h1 align="center"'+alertt+'>'+ hour +' Hour '+ minute +' Minutes '+ second + ' Seconds<br/>Remaining</h1><hr>'
        );

        second --;

        if(second<0){
          second = 59;
          minute --;

          if(minute<0){
            minute=59;
            hour --;
            
            if(hour < 0) { 
              clearInterval(x); 
              // var essay_form = document.getElementById("finish"); 
              // alert('Maaf, waktu anda telah habis...');
              // essay_form.click();
              document.getElementById("mc_question").submit();
            }
          }  
        }

      },1000)
    }

    function finish(){
      $('#finish').click(function(){
        var radio = $('.radio'), formValid = true;
        empty = [];
        for( var j=0; j<radio.length; j++ ) {
          if( isNnChecked(radio[j], "radio") ) {
            empty.push(j+1)
            formValid = false;
          }
        }
        if(formValid){
          var conf = confirm("Are you sure want to submit it???");
        
          if(conf==true){
            $('#finish').hide();
          }else{
            $('#finish').show();
          }
          return conf;
        }else{
          var conf = confirm(`Answer undefined on question number ${empty}`);
        
          if(conf==true || conf==false){
            return false;
          }
          return conf;
          
        }
          
        function isNnChecked(sel) {
         
          var check = sel.getElementsByTagName('input');
          for (var i=0; i<check.length; i++) {
            if (check[i].type == 'radio' && check[i].value == 'NN' && check[i].checked) {
              return true;
            } 
          }
          return false;
        }
      });
    }
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
		var current = 1,current_step,next_step,steps;
		steps = $("fieldset").length;
    
    current_step = $(this).show();
		
		$(".next").click(function(){
		current_step = $(this).parent();
		next_step = $(this).parent().next();
		next_step.show();
		current_step.hide();
		setProgressBar(++current);
    window.scroll({
      top: 200,
      left: 0,
      behavior: 'smooth'
    })
		});
		
		$(".previous").click(function(){
		current_step = $(this).parent();
		next_step = $(this).parent().prev();
		next_step.show();
		current_step.hide();
		setProgressBar(--current);
    window.scroll({
      top: 200,
      left: 0,
      behavior: 'smooth'
    })
		});
			
		setProgressBar(current);
  // Change progress bar action
		function setProgressBar(curStep){
		var percent = parseFloat(100 / steps) * curStep;
		percent = percent.toFixed();
		$(".progress-bar")
		.css("width",percent+"%")
		.html(percent+"%");   
		}
	});

  
</script>
{{-- <script src="{{ asset('js/mc_validation.js') }}"></script> --}}

@endsection