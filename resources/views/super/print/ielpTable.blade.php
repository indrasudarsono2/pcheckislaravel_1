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
			border-collapse:collapse;
			margin:0 auto;
			
	}
  td, tr, th{
			padding:5px;
			border:1px solid #333;
	}
		@page {
                margin: 0px 0px;
            }
		body {
				margin-top: 1.4cm;
				margin-left: 1cm;
				margin-right: 1cm;
				margin-bottom: 1.4cm;
			}

		h4, p{
					margin:0px;
			}
    
    font{
      size: 4;
    }
				
	</style>
	<center><h1>IELP Expiration</h1></center>
  <table class="table-hover">
    <thead>
      <tr>
        <td width="10px" align="center" scope="col"><b>No</b></td>
        <td width="50px" align="center" scope="col"><b>Name</b></td>
        <td width="50px" align="center" scope="col"><b>IELP Expiration</b></td>
      </tr>
    </thead>
    <tbody>
      @for($i=0; $i<$count_ielp; $i++)
      <tr>
        <td align="center" style="background:">{{ $no++ }}</td>
        <td align="left">{{ $ielp2[$i][0]->user->name }}</td>
        <td align="center" 
        @if ($ielp2[$i][0]->expired<$three) 
        style="background:#FF6347; color:white;"
        @elseif($ielp2[$i][0]->expired<$six) 
        style="background:#DAA520; color:white"
        @elseif($ielp2[$i][0]->expired<$nine) 
        style="background:#228B22; color:white"
        @endif
        >{{ $ielp2[$i][0]->expired->format('d F Y') }}</td>
      </tr>
      @endfor
    </tbody>
  </table>
  


</body>

</html>