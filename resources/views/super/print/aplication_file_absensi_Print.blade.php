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
	<center><h1>Pembekalan PC Tahun {{ $session->year }} Periode {{ $session->period }}</h1></center>
  <table class="table-hover">
    <thead>
      <tr>
        <td width="10px" align="center" scope="col"><b>No</b></td>
        <td width="10px" align="center" scope="col"><b>Remark</b></td>
        <td width="50px" align="center" scope="col"><b>Name</b></td>
        <td width="50px" align="center" scope="col"><b>Debriefing`s  date</b></td>
        <td width="150px" align="center" scope="col"><b>Sign</b></td>
      </tr>
    </thead>
    <tbody>
      @foreach ($aplication_file as $af)
      <tr>
        <td align="center">{{ $loop->iteration }}</td>
        <td align="center">{{ $af->remark_ap_file->remark }}</td>
        <td align="left">{{ $af->user->name }}</td>
        <td align="center">@if($af->provision_date==null) NO DATA @else {{ $af->provision_date->format('d F Y H:i:s') }}@endif</td>
        <td width="150px" align="center"></td>
      </tr>
      @endforeach
    </tbody>
    </tbody>
  </table>
  


</body>

</html>