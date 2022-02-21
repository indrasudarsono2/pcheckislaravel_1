<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Print Result</title>
</head>

<body>
	<style>
     /* table{
			border:1px solid #333;
			border-collapse:collapse;
			margin:0 auto;
			
	} */
		
		@page {
                margin: 0px 0px;
            }
		body {
				margin-top:1cm;
				margin-left: 1cm;
				margin-right: 1cm;
				margin-bottom: 1cm;
			}

		h4, p{
					margin:0px;
			}
    
    font{
      size: 4;
    }
				
	</style>
	
  <table class="table-hover">
    <thead>
      <tr>
        <td colspan="4">
          <center><font size="31px"><b>Checkers and Participants List</b></font></center>
        </td>
      </tr>
    </thead>
    @for($h=1; $h<=$ceil;$h++)
      <tr>
        @for($i=(($h*4)-4); $i<(4*$h); $i++)
          @if ($i==$count)
              @break
          @else
            <td width="250px" align="center" scope="col" style="border: 1px solid black"><b>{{ $group_checker[$i] }}</b></td>
          @endif
        @endfor
      </tr>
    
    <tbody>
      <tr>
        @for($i=(($h*4)-4); $i<(4*$h); $i++)
          @if ($i==$count)
            @break
          @else
            <td width="250px" align="left" valign="top" scope="col" style="border: 1px solid black">
              @for($j=0; $j<count($group_member[$i]); $j++)
              {{$j+1}}. {{ $group_member[$i][$j]->user->name }} <br/>
              @endfor
          </td>
          @endif
        @endfor
      </tr>
    </tbody>
    @endfor
  </table>
  


</body>

</html>