<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Print Publishing File</title>
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
	<div class="container">
		<font size="15px"><p style="text-align: right">.........................., {{ $now }}</p></font>
		<font size="15px"><p>Nomor   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $aplication_file->number }}-{{ $aplication_file->remark }}</p></font>
		<font size="15px"><p>Klasifikasi : @foreach ($form_rating as $fr){{ $fr->rating->rating }} @endforeach</p></font>
		<font size="15px"><p>Lampiran   &nbsp;&nbsp;: -</p></font>
		<font size="15px"><p>Prihal   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Permohonan Penerbitan Rating Personel Pemandu Lalu Lintas Penerbangan</p></font>
		<br/>
		<font size="15px"><p>Kepada</p></font>
		<font size="15px"><p>Yth. ATC Checker</p></font>
		<font size="15px"><p>Di</p></font>
		<font size="15px"><p>Tempat</p></font>
		<br/>
		<font size="15px"><p style="text-indent: 1cm">Dengan hormat yang bertanda tangan dibawah ini :</p></font>
		<table>
			<tbody>
				<tr>
					<td><font size="15px">1. Nama Lengkap</font></td>
					<td>:</td>
					<td><font size="15px">{{ Auth::user()->name }}</font></td>
				</tr>
				<tr>
					<td><font size="15px">2. Nomor Lisensi</font></td>
					<td>:</td>
					<td><font size="15px">{{ Auth::id() }}</font></td>
				</tr>
				<tr>
					<td><font size="15px"><p>3. Tempat dan Tanggal Lahir </p></font></td>
					<td>:</td>
					<td><font size="15px">{{ $biodata->place_of_birth }}, {{ $biodata->date_of_birth->format('d F Y') }}</font></td>
				</tr>
				<tr>
					<td><font size="15px">4. Alamat Unit Kerja</font></td>
					<td>:</td>
					<td><font size="15px">{{ $aplication_file->address }}</font></td>
				</tr>
				<tr>
					<td><font size="15px">5. Jumlah Jam Pemanduan</font></td>
					<td>:</td>
					<td><font size="15px">{{ $aplication_file->control->control_hours }} jam</font></td>
				</tr>
			</tbody>
		</table>
		<font size="15px"><p style="padding: 2px">Mengajukan permohonan untuk penerbitan rating @foreach ($form_rating as $fr){{ $fr->rating->rating }} @endforeach
		 di Perum LPPNPI Unit {{ $aplication_file->ats_name }}.</p></font>
		<font size="15px"><p style="text-indent: 1cm; padding: 2px;">Sebagai pertimbangan, bersama ini dilampirkan :</p></font>
		<font size="15px"><p style="padding: 2px">a. Formulir permohonan penerbitan rating</p></font>
		<font size="15px"><p style="padding: 2px">b. Buku lisensi (asli) personel pemandu lalu lintas penerbangan</p></font>
		<font size="15px"><p style="padding: 2px">c. Sertifikat kesehatan minimal kelas 3(tiga) yang masih berlaku</p></font>
		<font size="15px"><p style="padding: 2px">d. Sertifikat ICAO Language Proficiency minimal operational level 4(empat) yang masih berlaku</p></font>
		<font size="15px"><p style="padding: 2px">e. Sertifikat kompetensi atau ijazah dari lembaga pelatihan yang disetujui</p></font>
		<font size="15px"><p style="padding: 2px">f. Fotokopi ATC Personel Log Book</p></font>
		<font size="15px"><p style="text-indent: 1cm; padding:2px;">Demikian disampaikan, atas perhatiannya terima kasih.</p></font>
		<br/>
		<br/>
		<table>
			<tr>
				<td width="250px" align="center">
					<font size="15px">Pemohon</font>
				</td>
			</tr>
			<tr>
				<td width="250px" height="70px" valign="bottom" align="center">
					<font size="15px">{{ Auth::user()->name }}</font>
				</td>
			</tr>
		</table>
		
	</div>
</body>

</html>