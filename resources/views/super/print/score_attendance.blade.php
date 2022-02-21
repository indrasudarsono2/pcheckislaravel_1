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
				margin-left: 0.5cm;
				margin-right: 0.5cm;
				margin-bottom: 1.4cm;
			}

		h4, p{
					margin:0px;
			}
    
    font{
      size: 4;
    }
				
	</style>
	<center><h2>Absensi Ujian Teori {{ $remark_ap_file->remark }} Rating {{ $aplication_rating->rating->rating }} tahun {{ $session->year }} periode {{ $session->period }}</h2></center>
  <table class="table-hover">
    <thead>
      <tr>
        <td width="10px" align="center" scope="col"><b>No</b></td>
        <td width="10px" align="center" scope="col"><b>Date</b></td>
        <td width="5px" align="center" scope="col"><b>No License</b></td>
        <td width="20px" align="center" scope="col"><b>Name</b></td>
        <td width="20px" align="center" scope="col"><b>Rating</b></td>
        <td width="150px" align="center" scope="col"><b>Sign</b></td>
      </tr>
    </thead>
    <tbody>
      @foreach ($score as $score)
      <tr>
        <td align="center">{{ $loop->iteration }}</td>
        <td align="center">{{ $score->updated_at->format('d-m-Y H:i:s') }}</td>
        <td align="center">{{ $score->form_rating->aplication_file->user->id }}</td>
        <td align="left">{{ $score->form_rating->aplication_file->user->name }}</td>
        <td align="center">{{ $score->form_rating->rating->rating }}</td>
        <td align="center"></td>
      </tr>
      @endforeach
    </tbody>
    </tbody>
  </table>
  


</body>

</html>