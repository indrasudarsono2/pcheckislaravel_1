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
	<center><h1>Rekapitulasi score {{ $remark_ap_file->remark }} Rating {{ $aplication_rating->rating->rating }} tahun {{ $session->year }} periode {{ $session->period }}</h1></center>
  <table class="table-hover">
    <thead>
      <tr>
        <td width="10px" align="center" scope="col"><b>No</b></td>
        <td width="10px" align="center" scope="col"><b>Date</b></td>
        <td width="10px" align="center" scope="col"><b>No License</b></td>
        <td width="50px" align="center" scope="col"><b>Name</b></td>
        <td width="10px" align="center" scope="col"><b>Rating</b></td>
        <td width="50px" align="center" scope="col"><b>Score</b></td>
        <td width="50px" align="center" scope="col"><b>Remark</b></td>
      </tr>
    </thead>
    <tbody>
      @foreach ($score as $score)
      <tr>
        <td align="center">{{ $no++ }}</td>
        <td align="center">{{ date('d-m-Y H:i:s', strtotime($score->updated_at)) }}</td>
        <td align="center">{{ $score->user_id }}</td>
        <td align="left">{{ $score->name }}</td>
        <td align="center">{{ $aplication_rating->rating->rating }}</td>
        <td align="center">{{ $score->score }}</td>
        <td align="center">{{ $score->remark }}</td>
      </tr>
      @endforeach
    </tbody>
    </tbody>
  </table>
  


</body>

</html>