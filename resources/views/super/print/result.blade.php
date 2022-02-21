<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Print Result</title>
</head>

<body>
	<style>
		
		@page {
                margin: 0px 0px;
            }
		body {
				margin-top: 2cm;
				margin-left: 2cm;
				margin-right: 2cm;
				margin-bottom: 2cm;
			}

		h4, p{
					margin:0px;
			}

				
	</style>
	<div class="table-responsive">
    <div class="table-responsive">
      <table>
        <tr><td><font size="30px"><b>{{ $score->score }}</b></font></td></tr>
        <tr><td><font size="15px">{{ $score->form_rating->aplication_file->user->name }}</font></td></tr>
        <tr><td><font size="15px">Rating {{ $score->form_rating->rating->rating }}</font></td></tr>
      </table>
      
      <h2>Multiple Choice</h2>
      @for ($i = 0; $i < $count_mcc; $i++)
        <table style="border: 0px">
          <tr>
            <td width="40px" valign="top" style="border: 0px">{{ $no++ }}.</td>
            <td width="600px" style="border: 0px">{{ $mc_correction[$i]->mc_question->question }}</td>
          </tr>
          <tr>
            <td width="40px" valign="top" style="border: 0px"></td>
            <td width="600px" style="border: 0px">
              <div class="form-check form-check-inline">
                @if ($mc_correction[$i]->answer=="A")
                  @if ($mc_correction[$i]->answer == $mc_correction[$i]->mc_question->key)
                    <label class="form-check-label" for="1" style="color: green">
                      A. {{ $mc_correction[$i]->mc_question->a }}
                    </label>
                  @else
                    <label class="form-check-label" for="1" style="color: red">
                      A. {{ $mc_correction[$i]->mc_question->a }} <u>{{$mc_correction[$i]->mc_question->key}}</u>
                    </label>
                  @endif
                @else
                  <label class="form-check-label" for="1">
                    A. {{ $mc_correction[$i]->mc_question->a }}
                  </label>
                @endif
              </div>
            </td>
          </tr>
          <tr>
            <td width="40px" valign="top" style="border: 0px"></td>
            <td width="600px" style="border: 0px">
              <div class="form-check form-check-inline">
                @if ($mc_correction[$i]->answer=="B")
                  @if ($mc_correction[$i]->answer == $mc_correction[$i]->mc_question->key)
                    <label class="form-check-label" for="1" style="color: green">
                      B. {{ $mc_correction[$i]->mc_question->b }}
                    </label>
                  @else
                    <label class="form-check-label" for="1" style="color: red">
                      B. {{ $mc_correction[$i]->mc_question->b }} <u>{{$mc_correction[$i]->mc_question->key}}</u>
                    </label>
                  @endif
                @else
                  <label class="form-check-label" for="1">
                    B. {{ $mc_correction[$i]->mc_question->b }}
                  </label>
                @endif
              </div>
            </td>
          </tr>
          <tr>
            <td width="40px" valign="top" style="border: 0px"></td>
            <td width="600px" style="border: 0px">
              <div class="form-check form-check-inline">
                @if ($mc_correction[$i]->answer=="C")
                  @if ($mc_correction[$i]->answer == $mc_correction[$i]->mc_question->key)
                    <label class="form-check-label" for="1" style="color: green">
                      C. {{ $mc_correction[$i]->mc_question->c }}
                    </label>
                  @else
                    <label class="form-check-label" for="1" style="color: red">
                      C. {{ $mc_correction[$i]->mc_question->c }} <u>{{$mc_correction[$i]->mc_question->key}}</u>
                    </label>
                  @endif
                @else
                  <label class="form-check-label" for="1">
                    C. {{ $mc_correction[$i]->mc_question->c }}
                  </label>
                @endif
              </div>
            </td>
          </tr>
          <tr>
            <td width="40px" valign="top" style="border: 0px"></td>
            <td width="600px" style="border: 0px">
              <div class="form-check form-check-inline">
                @if ($mc_correction[$i]->answer=="D")
                  @if ($mc_correction[$i]->answer == $mc_correction[$i]->mc_question->key)
                    <label class="form-check-label" for="1" style="color: green">
                      D. {{ $mc_correction[$i]->mc_question->d }}
                    </label>
                  @else
                    <label class="form-check-label" for="1" style="color: red">
                      D. {{ $mc_correction[$i]->mc_question->d }} <u>{{$mc_correction[$i]->mc_question->key}}</u>
                    </label>
                  @endif
                @else
                  <label class="form-check-label" for="1">
                    D. {{ $mc_correction[$i]->mc_question->d }}
                  </label>
                @endif
              </div>
            </td>
          </tr>
        </table>
      @endfor
      <h2>Essay</h2>
      <table style="border: 0px">
      @foreach ($essay_correction as $essay_correction)
        <tr>
          <td width="40px" valign="top" style="border: 0px">{{ $loop->iteration }}.</td>
          <td width="600px" style="border: 0px">{{ $essay_correction->essay->essay }}</td>
        </tr>
        <tr>
          <td width="40px" valign="top" style="border: 0px"></td>
          <td width="600px" style="border: 0px">Answer: {{ $essay_correction->essay_answer }}</td>
        </tr>
        <tr>
          <td width="40px" valign="top" style="border: 0px"></td>
          <td width="600px" style="border: 0px"><b>{{ $essay_correction->checker->name }}</b> : {{ $essay_correction->essay_score }}</td>
        </tr>
      @endforeach
      </table>    
    </div>
	</div>


</body>

</html>