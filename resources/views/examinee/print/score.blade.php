<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Print Score</title>
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
		.kemenhub{
		width: 80px;
		top:198px;
		left:10px;
	}	

				
	</style>
	<div class="table-responsive">
		<div align="center">
			@if ($score->form_rating->aplication_file->remark_ap_file_id==1)
				<h3>
				UJIAN {{ $score->form_rating->aplication_file->remark_ap_file->remark }} 
				RATING PERIODE {{ $score->form_rating->aplication_file->session->period }} 
				TAHUN {{ $score->form_rating->aplication_file->session->year }}
				</h3>
			@else
				<h3>
				UJIAN {{ $score->form_rating->aplication_file->remark_ap_file->remark }} 
				RATING PERIODE {{ $score->form_rating->aplication_file->session->period }} 
				TAHUN {{ $score->form_rating->aplication_file->session->year }}
				<br/>
				{{ $score->form_rating->aplication_file->session->text }}
				</h3>
			@endif
			
		
			<font size="80px">{{ $score->score }}</font>
			
			<table align="center">
					<tr>
						<td><font size="15px">Nama</font></td>
						<td>:</td>
						<td><font size="15px">{{ Auth::user()->name }}</font></td>
					</tr>
					<tr>
						<td><font size="15px">Tanggal</font></td>
						<td>:</td>
						<td><font size="15px">{{ $score->updated_at->format('d F Y H:i:s') }}</font></td>
					</tr>
					<tr>
						<td><font size="15px">Nomor License</font></td>
						<td>:</td>
						<td><font size="15px">{{ Auth::id() }}</font></td>
					</tr>
					<tr>
						<td><font size="15px">Rating</font></td>
						<td>:</td>
						<td><font size="15px">{{ $score->form_rating->rating->rating }}</font></td>
					</tr>
					<tr>
						<td><font size="15px">Keterangan</font></td>
						<td>:</td>
						<td><font size="15px"><u>{{ $score->remark_score->remark }}</u></font></td>
					</tr>
			</table>
		</div>
	</div>
	<br/>
	<div class="table-responsive">
		<div align="center">
			<table>
				<tr>
					<td width="300px" rowspan="3" valign="top" align="center"><b>Checker</b></td>
					<td width="300px" valign="top" align="center"><b>Peserta</b></td>
				</tr>
				<tr style="border: 0px; padding:0px">
					<td width="300px" align="center" style="border: 0px; padding:3px">
						<img src="data:image/svg;base64, {!! base64_encode(QrCode::format('png')->merge('/airnav.jpg')->size(100)->generate(Auth::user()->name.'-'.Auth::id()))!!} "  class="kemenhub" alt="logo">
					</td>
				</tr>
				<tr>
					<td width="300px" align="center">{{ Auth::user()->name }}</td>
				</tr>
			</table>
		</div>
	</div>
</body>

</html>