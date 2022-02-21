<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Print Checklist</title>
</head>

<body>
	<style>
		/* table {
			border-collapse: collapse;
			position: relative;
			border-right:1px;
			border-left: 1px;
			border-top: 1px;
			border-bottom: 1px;
		} */
		/* table {
    border-left: 0.01em solid #ccc;
    border-right: 0;
    border-top: 0.01em solid #ccc;
    border-bottom: 0;
    border-collapse: collapse;
		} */

		/* table,
		th,
		tr,
		td {
			border: 1px solid black;
		}

		th, td {
            padding: 5px;
        }
		.lurus{
				text-indent: 18px;
			} */
		

			/* body{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:18px;
            margin:0;
        } */
	.kemenhub{
		width: 80px;
		top:198px;
		left:10px;
	}

	table{
			border:1px solid #333;
			border-collapse:collapse;
			margin:0 auto;
			
	}
	td, tr, th{
			padding:5px;
			border:1px solid #333;
	}
	th{
			background-color: #f0f0f0;
	}
	h4, p{
			margin:0px;
	}		
	
	@page {
					margin: 0px 0px;
			}
	
	body {
			margin-top: 1cm;
			margin-left: 1cm;
			margin-right: 1cm;
			margin-bottom: 1cm;
		}

	h4, p{
				margin:0px;
		}
	</style>
	<div class="container">
    <center><font size="16px"><b>CHECKLIST PERSYARATAN ADMINISTRASI {{$aplication_file->remark_ap_file->remark}} RATING</b></font><center>
		<br/><br/>
    <table>
			<thead>
        <tr>
          <th width="20px" align="center">No</th>
          <th width="300px" align="center">Persyaratan</th>
          <th width="70px" align="center">Status</th>
          <th width="70px" align="center">Kesesuaian</th>
          <th width="200px" align="center">Keterangan</th>
        </tr>
			</thead>
      <tbody>
        @for($i = 0 ; $i < count($verification_data) ; $i++)
          <tr>
            <td align="center">{{ $i+1 }}</td>
            <td align="left">
              {{ $verification_data[$i]->verification_item->item }}
              @if($i==3)<br/>@foreach($aplication_file->form_rating as $rating) <li style="list-style-type: none;">- {{ $rating->rating->full }}</li>@endforeach
              @elseif($i+1 == count($verification_data)) <br/>@foreach($aplication_file->form_rating as $rating) <li style="list-style-type: none;">- {{ $rating->rating->full }} : {{ $rating->control_hours }}</li>@endforeach 
              @endif
            </td>
            <td align="center">{{ $verification_data[$i]->status }}</td>
            <td align="center">{{ $verification_data[$i]->match }}</td>
            <td align="left" style="text-align: justify; justify-content: inter-word">{{ $verification_data[$i]->remark }}</td>
          </tr>
        @endfor
        <tr>
          <td colspan="2">Tanggal : {{ $verification_data[0]->updated_at->format('d F Y') }}</td>
          <td colspan="3" style="border-bottom:none;">Tanda Tangan : </td>
        </tr>
        <tr>
          <td colspan="2" rowspan="2">Pemeriksa : {{ $verification_data[0]->checker->name}}</td>
          <td colspan="3" align="center" style="border-top:none;border-bottom:none;"><img src="data:image/svg;base64, {!! base64_encode(QrCode::format('png')->merge('/airnav.jpg')->size(100)->generate($aplication_file->user->name.'-'.$aplication_file->user_id))!!} "  class="kemenhub" alt="logo"></td>
        </tr>
        <tr>
          <td colspan="3" align="center" style="border-top:none;">({{ $aplication_file->user->name }})</td>
        </tr>
      </tbody>
		</table>
	</div>
</body>
</html>