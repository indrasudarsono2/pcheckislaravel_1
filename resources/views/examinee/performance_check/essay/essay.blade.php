@extends('examinee/main')

@section('title', 'Essay`s Question')
    
@section('section-header')
<h1>{{ $performance_check->question_varian->varian }}`s Question</h1>    
@endsection

@section('section-title')
    Question
@endsection

@section('contain')
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/validation.js') }}"></script>
        
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div id='timer'><h1 align="center"></div>
      <div class="card-body">
        <form method="post" id="essay_form" name="frmupload" action="{{ route('form_ratings.performance_checks.question_varians.store', [$form_rating, $performance_check]) }}">
          @csrf
          
          <br>
          <div class="table-responsive">
            <table style="border: 0px">
              @for ($i=0; $i<$count; $i++)
                @for ($j=0; $j<$essay_group_quantity[$i]; $j++)
                  <tr>
                    <td width="40px" valign="top" style="border: 0px">{{ $no++ }}.</td>
                    <td width="1250px" style="border: 0px">{{ $essay[$i][$j]->essay }}</td>
                  </tr>
                  <tr>
                    <td style="border: 0px"><input type="text" name="essay_id[]" id="" value="{{ $essay[$i][$j]->id }}" hidden></td>
                    <td style="border: 0px">
                      <textarea id="answer_id[{{ $essay[$i][$j]->id }}]" name="answer[{{ $essay[$i][$j]->id }}]" class="form-control" 
                      style="height: 150px; width:1250px;" onpaste="return false"></textarea>
                    </td>
                  </tr>
                @endfor
              @endfor
            </table>
          </div>
            
          <button type="submit" class="btn btn-success fas fa-shipping-fast" id="finish"> Finish</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function () {
    var second = 0;
    var minute = "<?php echo $minute; ?>";
    var hour = "<?php echo $hour; ?>";
    var second_2 = 5;
    
    finish();
    interval();    

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
              document.getElementById("essay_form").submit();
            }
          }  
        }

      },1000)
    }

    function finish(){
      $('#finish').click(function(){
        var conf = confirm("Are you sure???");
       
        if(conf==true){
          $('#finish').hide(setInterval(function(){
            $('#finish').show();
          }, 30000));
        }else{
          $('#finish').show();
        }
        return conf;
      })
    }
  });

 
</script>

@endsection