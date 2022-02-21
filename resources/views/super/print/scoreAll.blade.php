<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Print Result</title>
</head>

<body>
	<style>
    table{
			border:1px solid #333;
			border-collapse: collapse;
			margin:0 auto;
			
	}
  td, tr, th{
			padding:2px;
			border:1px solid #333;
	}
		@page {
                margin: 0px 0px;
            }
		body {
				margin-top: 1cm;
				margin-left: 0.5cm;
				margin-right: 0.5cm;
				margin-bottom: 1cm;
			}

		h4, p{
					margin:0px;
			}
    
    font{
      size: 1;
    }
				
	</style>
		<center><h1>Rekapitulasi {{ $remark_ap_file->remark }} Tahun {{ $session->year }}@if($remark_ap_file->id==2)<br>Periode {{ $session->text }}@endif</h1></center>
  <table class="table-hover">
    <thead>
      <tr>
        <td width="10px" align="center" scope="col"><b>No</b></td>
        <td width="20px" align="center" scope="col"><b>Name</b></td>
        <td width="2px" align="center" scope="col"><b>No<br>License</b></td>
        <td width="20px" align="center" scope="col"><b>Valid<br>IELP</b></td>
        <td width="20px" align="center" scope="col"><b>Valid<br>MEDEX</b></td>
        <td width="2px" align="center" scope="col"><b>Rating</b></td>
        <td width="20px" align="center" scope="col"><b>Theory<br>Exam</b></td>
        <td width="20px" align="center" scope="col"><b>Practical<br>Exam</b></td>
        <td width="2px" align="center" scope="col"><b>Checker Name</b></td>
        <td width="2px" align="center" scope="col"><b>Remark</b></td>
      </tr>
    </thead>
    <tbody>
      @for($i=0;$i<count($aplication_file);$i++)
      <tr>
        <td align="center">{{ $no++ }}</td>
        <td align="left">{{ $aplication_file[$i]->user->name }}</td>
        <td align="center">{{ $aplication_file[$i]->user->id }}</td>
        <td align="center">{{ $aplication_file[$i]->ielp->expired->format('d-m-Y') }}</td>
        <td align="center">{{ $aplication_file[$i]->medex->expired->format('d-m-Y') }}</td>
        <td align="center">
          @for($j=0; $j<count($aplication_file[$i]->form_rating); $j++)
            @if (count($aplication_file[$i]->form_rating)>1)
              {{ $aplication_file[$i]->form_rating[$j]->rating->rating }}<br>
            @else
              {{ $aplication_file[$i]->form_rating[$j]->rating->rating }}
            @endif
          @endfor
        </td>
        <td align="center">
          @for($j=0; $j<count($aplication_file[$i]->form_rating); $j++)
            @if (count($aplication_file[$i]->form_rating)>1)
              @for($k=count($aplication_file[$i]->form_rating[$j]->score); $k>=count($aplication_file[$i]->form_rating[$j]->score); $k--)
                @if(empty($aplication_file[$i]->form_rating[$j]->score[$k-1]))
                  None
                @else
                  {{ $aplication_file[$i]->form_rating[$j]->score[$k-1]->score }}<br>
                @endif
              @endfor
            @else
              @for($k=count($aplication_file[$i]->form_rating[$j]->score); $k>=count($aplication_file[$i]->form_rating[$j]->score); $k--)
                @if(empty($aplication_file[$i]->form_rating[$j]->score[$k-1]))
                  None
                @else
                  {{ $aplication_file[$i]->form_rating[$j]->score[$k-1]->score }}
                @endif
              @endfor
            @endif
          @endfor
        </td>
        <td align="center">
          @for($j=0; $j<count($aplication_file[$i]->form_rating); $j++)
            @if (count($aplication_file[$i]->form_rating)>1)
              @for($k=0; $k<count($aplication_file[$i]->form_rating[$j]->practical_exam); $k++)
              {{ $aplication_file[$i]->form_rating[$j]->practical_exam[$k]->score }}<br>
              @endfor
            @else
              @for($k=0; $k<count($aplication_file[$i]->form_rating[$j]->practical_exam); $k++)
              {{ $aplication_file[$i]->form_rating[$j]->practical_exam[$k]->score }}
              @endfor
            @endif
          @endfor
        </td>
        <td align="left">
          @for($j=0; $j<count($aplication_file[$i]->form_rating); $j++)
            @if (count($aplication_file[$i]->form_rating)>1)
              @for($k=0; $k<count($aplication_file[$i]->form_rating[$j]->practical_exam); $k++)
                {{ Str::substr($aplication_file[$i]->form_rating[$j]->practical_exam[$k]->user->name, 0, 15) }}<br>
              @endfor
            @else
              @for($k=0; $k<count($aplication_file[$i]->form_rating[$j]->practical_exam); $k++)
                {{ Str::substr($aplication_file[$i]->form_rating[$j]->practical_exam[$k]->user->name, 0, 15) }}<br>
              @endfor
            @endif
          @endfor
        </td>
        <td align="center">
          @for($j=0; $j<count($aplication_file[$i]->form_rating); $j++)
            @if (count($aplication_file[$i]->form_rating)>1)
              @for($k=count($aplication_file[$i]->form_rating[$j]->score); $k>=count($aplication_file[$i]->form_rating[$j]->score); $k--)
                @if(empty($aplication_file[$i]->form_rating[$j]->score[$k-1]))
                  None
                @else
                  {{ Str::substr( $aplication_file[$i]->form_rating[$j]->score[$k-1]->remark_score->remark, 0, 9) }}<br>
                @endif
              @endfor
            @else
              @for($k=count($aplication_file[$i]->form_rating[$j]->score); $k>=count($aplication_file[$i]->form_rating[$j]->score); $k--)
              @if(empty($aplication_file[$i]->form_rating[$j]->score[$k-1]))
                  None
                @else
                  {{ Str::substr( $aplication_file[$i]->form_rating[$j]->score[$k-1]->remark_score->remark, 0, 9) }}
                @endif
              @endfor
            @endif
          @endfor
        </td>
      </tr>
      @endfor
    </tbody>
    </tbody>
  </table>
  


</body>

</html>