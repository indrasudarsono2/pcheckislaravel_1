@extends('examinee/main')

@section('title', 'Aplication Files')

@section('section-header')
<h1>Print Aplication FIle</h1>
@endsection

@section('section-title')
Print    
@endsection

@section('contain')

<button id="printButton" class="btn btn-danger fas fa-print"> Print</button>

<div class="container">
	<table>
		<tr>
			<th width="150x"><img src="{{  asset('img/kemenhub.png') }}" class="kemenhub"></th>
			<th width="550px" colspan="6">
				<center><font size="3px"><b>KEMENTRIAN PERHUBUNGAN</b></font></center>
				<center><font size="3px"><b>DIREKTORAT JENDRAL PERHUBUNGAN UDARA</b></font></center>
				<center><font size="3px"><b>DIREKTORAT NAVIGASI PENERBANGAN</b></font></center>
				<center><font size="2px">Gedung Karya, Lantai 23. Jl. Medan Merdeka Barat No.8 Jakarta 10110-Indonesia</font></center>
				<center><font size="2px">Telpon: (62-21)350 6451, 3506553 Fax: (62-21)350 6663</font></center>
			</th>
		</tr>
		<tr>
			<td width="700px" colspan="7" align="left"><font size="3px"><b>I. JENIS PERMOHONAN</b></font></td>
		</tr>
		<tr>
			<td width="700px" colspan="7" align="left" style=text-transform:uppercase><font size="3px"><b>A.</b> {{ $aplication_file->remark }}</font></td>
		</tr>
		<tr>
			<td width="150px" align="left"><font size="3px"><b>B.</b> Nama ATS Unit</font></td>
			<td width="550px" colspan="6" align="left" style=text-transform:uppercase><font size="3px">{{ $aplication_file->ats_name }}</font></td>
		</tr>
		<tr>
			<td width="150px" align="left"><font size="3px"><b>C.</b> Alamat Kantor</font></td>
			<td width="550px" colspan="6" align="left" style=text-transform:uppercase><font size="3px">{{ $aplication_file->address }}</font></td>
		</tr>
		<tr>
			<td width="150px" align="left"><font size="3px"><b>D.</b> Jenis Rating yang dimohonkan</font></td>
			<td width="550px" colspan="6" align="left"><font size="3px">
			@foreach ($form_rating as $fr)
			<div class="form-check">
				<li>
					<label class="form-check-label">
						{{$fr->rating->full}}
					</label>
				</li>
			</div>
			@endforeach	
			</font></td>
		</tr>
		<tr>
			<td width="700px" colspan="9" align="left"><font size="3px"><b>II. INFORMASI PEMOHON</b></font></td>
		</tr>
		<tr>
			<td width="250px" colspan="2" align="left"><font size="3px"><b>1.</b> Nama:</font><br/>{{ Auth::user()->name }}</td>
			<td width="150px" align="left" valign="top" colspan="2"><font size="3px"><b>2.</b> Nomor Lisensi</font><br/>{{ Auth::id() }}</td>
			<td width="150px" align="left" valign="top" colspan="2"><font size="3px"><b>3.</b> Tanggal Lahir</font><br/>{{ $biodata->date_of_birth->format('d-m-Y') }}</td>
			<td width="150px" align="left" valign="top" colspan="2"><font size="3px"><b>4.</b> Tempat Lahir</font><br/>{{ $biodata->place_of_birth }}</td>
		</tr>
		<tr>
			<td width="250px" colspan="2" rowspan="2" align="left" valign="top"><font size="3px"><b>5.</b> Alamat:</font><br/>{{ $biodata->address_user }}</td>
			<td width="225px" align="left" colspan="3" valign="top"><font size="3px"><b>6.</b> Kebangsaan</font><br/>{{ $biodata->nationality }}</td>
			<td width="225px" align="left" colspan="2"><font size="3px"><b>7.</b> Apakah anda bisa berbahasa inggris?</font><br/>{{ $biodata->english_confirm }}</td>
		</tr>
		<tr>
			<td width="75px" align="left"><font size="3px"><b>8.</b> Tinggi</font><br/>{{ $biodata->height }}</td>
			<td width="75px" align="left"><font size="3px"><b>9.</b> Berat</font><br/>{{ $biodata->weight }}</td>
			<td width="75px" align="left"><font size="3px"><b>10.</b> Rambut</font><br/>{{ $biodata->hair }}</td>
			<td width="105px" align="left"><font size="3px"><b>11.</b> Mata</font><br/>{{ $biodata->eyes }}</td>
			<td width="120px" align="left"><font size="3px"><b>12.</b> Jenis Kelamin</font><br/>{{ $biodata->gender->gender }}</td>
		</tr>
		<tr>
			<td width="250px" colspan="2" rowspan="2" align="left" valign="top"><font size="3px"><b>13a.</b> Apakah anda pernah memiliki rating sebelumnya?</font><br/>{{ $rating_confirm->confirm }}</td>
			<td width="225px" rowspan="2" align="left" colspan="3" valign="top"><font size="3px"><b>13b.</b> Jika Ya, apakah rating anda dicabut atau dibekukan?</font><br/><li>{{ $remark_rating[0] }} ({{ $remark_rating[1] }})</li></td>
			<td width="105px" align="left" valign="top"><font size="3px"><b>13c.</b> Jenis rating</font><br/>@foreach ($rat as $rating) <li>{{ $rating->rating }}</li>@endforeach</td>
			<td width="120px" align="left" valign="top"><font size="3px"><b>13d.</b> Lokasi rating</font><br/>{{ $rating_confirm->location }}</td>
		</tr>
		<tr>
			<td width="225px" colspan="2" align="left" valign="top"><font size="3px"><b>13e.</b>Tanggal pencabutan/pembekuan/alasan lainnya:</font><br/>{{ $rating_confirm->date }}</td>
		</tr>
		<tr>
			<td width="325px" colspan="3" align="left" valign="top"><font size="3px"><b>14a.</b> Apakah anda memiliki sertifikat kesehatan Minimal level 3?</font><br/>{{ $aplication_file->medex->confirm }}</td>
			<td width="188px" colspan="2" align="left" valign="top"><font size="3px"><b>14b.</b>Tanggal dikeluarkan</font><br/>{{ $aplication_file->medex->released->format('d-m-Y') }}</td>
			<td width="187px" colspan="3" align="left" valign="top"><font size="3px"><b>14c.</b> Nama penguji</font><br/>{{ $aplication_file->medex->examiner }}</td>
		</tr>
		<tr>
			<td width="325px" colspan="3" rowspan="2" align="left" valign="top"><font size="3px"><b>15a.</b> Apakah anda memiliki sertifikat ICAO <i>Language Proficiency</i></font><br/>{{ $aplication_file->ielp->confirm }}</td>
			<td width="188px" colspan="2" align="left" valign="top"><font size="3px"><b>15b.</b> Nama Rater</font><br/>{{ $aplication_file->ielp->rater }}</td>
			<td width="187px" colspan="3" align="left" valign="top"><font size="3px"><b>15c.</b> Lembaga Pelatihan</font><br/>{{ $aplication_file->ielp->institution }}</td>
		</tr>
		<tr>
			<td width="188px" colspan="2" align="left" valign="top"><font size="3px"><b>15d.</b>Tanggal dikeluarkan</font><br/>{{ $aplication_file->ielp->released->format('d-m-Y') }}</td>
			<td width="187px" colspan="3" align="left" valign="top"><font size="3px"><b>15e.</b> Level</font><br/>{{ $aplication_file->ielp->level }}</td>
		</tr>
		<tr>
			<td width="325px" colspan="3" rowspan="3" align="left" valign="top"><font size="3px"><b>16a.</b> Apakah anda telah melaksanakan pemanduan Lalu Lintas Penerbangan dibawah pengawasan OJTI</font><br/>{{ $aplication_file->control->confirm }}<br/>*Hanya untuk penerbitan rating</td>
			<td width="188px" colspan="2" align="left" valign="top"><font size="3px"><b>16b.</b> Tanggal mulai</font><br/>{{ $aplication_file->control->start->format('d-m-Y') }}</td>
			<td width="187px" colspan="3" align="left" valign="top"><font size="3px"><b>16c.</b> Tanggal berakhir</font><br/>{{ $aplication_file->control->finish->format('d-m-Y') }}</td>
		</tr>
		<tr>
			<td width="375px" colspan="5" align="left" valign="top"><font size="3px"><b>16d.</b>Jumlah Jam Pemanduan</font><br/>{{ $aplication_file->control->control_hours }}</td>
		</tr>
		<tr>
			<td width="187px" colspan="2" align="left" valign="top"><font size="3px"><b>16e.</b> Nama OJTI</font><br/>{{ $aplication_file->control->user->name }}</td>
			<td width="187px" colspan="3" align="left" valign="top"><font size="3px"><b>16f.</b> Nomor Lisensi</font><br/>{{ $aplication_file->control->user_id }}</td>
		</tr>
		<tr>
			<td width="700px" colspan="9" align="left"><font size="3px"><p align="justify"><b>17.</b> Apakah anda terlibat pelanggaran yang disebabkan oleh penggunaan obat-obatan terlarang, marijuana dan obat anti depresi atau obat stimulant atau pengoperasian kendaraan bermotor dengan pengaruh alkhohol?</p></font><br/>{{ $aplication_file->drugs }}</td>
		</tr>
		<tr>
			<td width="700px" colspan="7" align="left"><font size="3px"><b>III. LATAR BELAKANG PENDIDIKAN</b></font></td>
		</tr>
		<tr>
			<td width="700px" colspan="7" align="left"><font size="3px"><b>1.</b> Jenis Pendidikan Formal</font><br/>
				@foreach ($education as $education)
				<li>
					{{ $education->formal_education->education }} Tahun <u>{{ $education->year }}</u>
				</li>
				@endforeach
			</td>
		</tr>
		<tr>
			<td width="325px" colspan="3" align="left" valign="center"><font size="3px"><b>2.</b> Jenis Sertifikat Kompetensi</font></td>
			<td width="188px" colspan="3" align="center" valign="center"><font size="3px">Lembaga Pelatihan</font></td>
			<td width="187px" colspan="2" align="center" valign="top"><font size="3px">Tanggal dikeluarkan</font></td>
		</tr>
		@foreach ($sertificate as $sertificate)
		<tr>
			<td width="325px" colspan="3" align="left" valign="center"><font size="3px"><li>{{ $sertificate->sertificate->sertificate }}</li></font></td>
			<td width="188px" colspan="3" align="center" valign="center"><font size="3px">{{ $sertificate->institution }}</font></td>
			<td width="187px" colspan="2" align="center" valign="top"><font size="3px">{{ $sertificate->released->format('d-m-Y') }}</font></td>
		</tr>	
		@endforeach
		<tr>
			<td width="700px" colspan="7" align="left"><font size="3px"><b>IV. APAKAH ANDA PERNAH GAGAL UJIAN SEBELUMNYA, DALAM KURUN WAKTU 30 HARI?</b></font><br/>{{ $aplication_file->failed }}</td>
		</tr>
		<tr>
			<td width="325px" colspan="3" rowspan="3" align="left" valign="center"><font size="3px"><p align="justifly"></p><b>V. PERNYATAAN VERIFIKASI PEMOHON <br/>Saya menjamin bahwa apa yang saya tuliskan dalam form ini adalah benar</b></p></font></td>
			<td width="188px" colspan="2" align="center" valign="center"><font size="3px">Tempat dan Tanggal</font></td>
			<td width="187px" colspan="3" align="center" valign="center"><font size="3px">Tanda Tangan</font></td>
		</tr>
		<tr>
			<td width="188px" colspan="2" rowspan="2" align="center" valign="center"><font size="3px">................, {{ $now }}</font></td>
			<td width="187px" colspan="3" rowspan="2" align="center" valign="bottom"><font size="3px">{{ Auth::user()->name }}</font></td>
		</tr>
	</table>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('printThis/printThis.js') }}"></script>
<script>

		$('#printButton').click(function(){
			$('.container').printThis();
		});
	
</script>
<script></script>
@endsection
		