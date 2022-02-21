   <!DOCTYPE html>
   <html lang="en">
   <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Document {{ $aplication_file->user->name }}</title>
     {{-- <link rel="stylesheet" href="{{ asset('stisla/assets/css/bootstrap.min.css') }}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
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
        margin-left: 2cm;
        margin-right: 2cm;
        margin-bottom: 1cm;
      }
  
    h4, p{
          margin:0px;
      }
    </style>
   </head>
   <body>
   
     
   
   </html>
    <div class="table-responsive">
      <table>
        <tr>
          <th width="150px" align="center"><img src={{ asset('kemenhub.png') }} class="kemenhub" alt="logo" style="width: 50%"></th>
          <th width="550px" colspan="7">
            <center><font size="3px"><b>KEMENTRIAN PERHUBUNGAN</b></font></center>
            <center><font size="3px"><b>DIREKTORAT JENDRAL PERHUBUNGAN UDARA</b></font></center>
            <center><font size="3px"><b>DIREKTORAT NAVIGASI PENERBANGAN</b></font></center>
            <center><font size="3px">Gedung Karya, Lantai 23. Jl. Medan Merdeka Barat No.8 Jakarta 10130-Indonesia</font></center>
            <center><font size="3px">Telpon: (62-21)350 6451, 3506553 Fax: (62-21)350 6663</font></center>
          </th>
        </tr>
        <tr>
          <td width="700px" colspan="8" align="left"><font size="2px"><b>I. JENIS PERMOHONAN</b></font></td>
        </tr>
        <tr>
          <td width="700px" colspan="8" align="left" style=text-transform:uppercase><font size="2px"><b>A.</b> {{ $aplication_file->remark_ap_file->remark }}</font></td>
        </tr>
        <tr>
          <td width="150px" align="left"><font size="2px"><b>B.</b> Nama ATS Unit</font></td>
          <td width="550px" colspan="7" align="left" style=text-transform:uppercase><font size="2px">{{ $aplication_file->ats_name }}</font></td>
        </tr>
        <tr>
          <td width="150px" align="left"><font size="2px"><b>C.</b> Alamat Kantor</font></td>
          <td width="550px" colspan="7" align="left" style=text-transform:uppercase><font size="2px">{{ $aplication_file->address }}</font></td>
        </tr>
        <tr>
          <td width="150px" align="left"><font size="2px"><b>D.</b> Jenis Rating yang dimohonkan</font></td>
          <td width="550px" colspan="7" align="left"><font size="2px">
          @foreach ($form_rating as $fr)
          <div class="form-check">
            <div>
              <label class="form-check-label">
                - {{$fr->rating->full}}
              </label>
            </div>
          </div>
          @endforeach	
          </font></td>
        </tr>
        <tr>
          <td width="700px" colspan="8" align="left"><font size="2px"><b>II. INFORMASI PEMOHON</b></font></td>
        </tr>
        <tr>
          <td width="250px" colspan="2" align="left" valign="top"><font size="2px"><b>1.</b> Nama:<br/>{{ $aplication_file->user->name }}</font></td>
          <td width="150px" align="left" valign="top" colspan="2"><font size="2px"><b>2.</b> Nomor Lisensi<br/>{{ $aplication_file->user_id }}</font></td>
          <td width="150px" align="left" valign="top" colspan="2"><font size="2px"><b>3.</b> Tanggal Lahir<br/>{{ $biodata->date_of_birth->format('d-m-Y') }}</font></td>
          <td width="150px" align="left" valign="top" colspan="2"><font size="2px"><b>4.</b> Tempat Lahir<br/>{{ $biodata->place_of_birth }}</font></td>
        </tr>
        <tr>
          <td width="250px" colspan="2" rowspan="2" align="left" valign="top"><font size="2px"><b>5.</b> Alamat:<br/>{{ $biodata->address_user }}</font></td>
          <td width="225px" align="left" colspan="3" valign="top"><font size="2px"><b>6.</b> Kebangsaan<br/>{{ $biodata->nationality }}</font></td>
          <td width="225px" align="left" colspan="3"><font size="2px"><b>7.</b> Apakah anda bisa berbahasa inggris?<br/></font><font size="2px" style="text-transform: uppercase">{{ $biodata->english_confirm }}</font></td>
        </tr>
        <tr>
          <td width="75px" align="left"><font size="2px"><b>8.</b> Tinggi<br/><b><i>confidential</i></b></font></td>
          <td width="75px" align="left"><font size="2px"><b>9.</b> Berat<br/><b><i>confidential</i></b></td>
          <td width="75px" align="left"><font size="2px"><b>10.</b> Rambut<br/><b><i>confidential</i></b></font></td>
          <td width="105px" align="left"><font size="2px"><b>11.</b> Mata<br/><b><i>confidential</i></b></td>
          <td width="120px" align="left" colspan="2"><font size="2px"><b>12.</b> Jenis Kelamin<br/>{{ $biodata->gender->gender }}</font></td>
        </tr>
        <tr>
          <td width="250px" colspan="2" rowspan="2" align="left" valign="top"><font size="2px"><b>13a.</b> Apakah anda pernah memiliki rating sebelumnya?<br/></font><font style="text-transform:uppercase" size="2px">{{ $rating_confirm->confirm }}</font></td>
          <td width="225px" rowspan="2" align="left" colspan="3" valign="top"><font size="2px"><b>13b.</b> Jika Ya, apakah rating anda dicabut atau dibekukan?<br/><div>@if($rating_confirm->confirm=='ya') {{ $remark_rating[0] }} ({{ $remark_rating[1] }})@endif</div></font></td>
          <td width="105px" align="left" valign="top"><font size="2px"><b>13c.</b> Jenis rating<br/>@foreach ($rat as $rating) <div>- {{ $rating->rating }}</div>@endforeach</font></td>
          <td width="120px" colspan="2" align="left" valign="top"><font size="2px"><b>13d.</b> Lokasi rating<br/>{{ $rating_confirm->location }}</font></td>
        </tr>
        <tr>
          <td width="225px" colspan="3" align="left" valign="top"><font size="2px"><b>13e.</b>Tanggal pencabutan/pembekuan/alasan lainnya:<br/>{{ $rating_confirm->date }}</font></td>
        </tr>
        <tr>
          <td width="325px" colspan="3" align="left" valign="top"><font size="2px"><b>14a.</b> Apakah anda memiliki sertifikat kesehatan Minimal level 3?<br/></font><font style="text-transform: uppercase" size="2px">{{ $aplication_file->medex->confirm }}</font></td>
          <td width="188px" colspan="2" align="left" valign="top"><font size="2px"><b>14b.</b>Tanggal dikeluarkan<br/>{{ $aplication_file->medex->released->format('d-m-Y') }}</font></td>
          <td width="187px" colspan="3" align="left" valign="top"><font size="2px"><b>14c.</b> Nama penguji<br/>{{ $aplication_file->medex->examiner }}</font></td>
        </tr>
        <tr>
          <td width="325px" colspan="3" rowspan="2" align="left" valign="top"><font size="2px"><b>15a.</b> Apakah anda memiliki sertifikat ICAO <i>Language Proficiency</i><br/></font><font style="text-transform: uppercase" size="2px">{{ $aplication_file->ielp->confirm }}</font></td>
          <td width="188px" colspan="2" align="left" valign="top"><font size="2px"><b>15b.</b> Nama Rater<br/>{{ $aplication_file->ielp->rater }}</font></td>
          <td width="187px" colspan="3" align="left" valign="top"><font size="2px"><b>15c.</b> Lembaga Pelatihan<br/>{{ $aplication_file->ielp->institution }}</font></td>
        </tr>
        <tr>
          <td width="188px" colspan="2" align="left" valign="top"><font size="2px"><b>15d.</b>Tanggal dikeluarkan<br/>{{ $aplication_file->ielp->released->format('d-m-Y') }}</font></td>
          <td width="187px" colspan="3" align="left" valign="top"><font size="2px"><b>15e.</b> Level<br/>{{ $aplication_file->ielp->level }}</font></td>
        </tr>
      
        <tr>
          <td width="325px" colspan="3" rowspan="3" align="left" valign="top"><font size="2px"><b>16a.</b> Apakah anda telah melaksanakan pemanduan Lalu Lintas Penerbangan dibawah pengawasan OJTI<br/></font><font style="text-transform: uppercase" size="2px">{{ $aplication_file->control->confirm }}<br/>*Hanya untuk penerbitan rating</font></td>
          <td width="188px" colspan="2" align="left" valign="top"><font size="2px"><b>16b.</b> Tanggal mulai<br/>@if ($aplication_file->control->confirm=="ya"){{ $aplication_file->control->start->format('d-m-Y') }}@endif</font></td>
          <td width="187px" colspan="3" align="left" valign="top"><font size="2px"><b>16c.</b> Tanggal berakhir<br/>@if ($aplication_file->control->confirm=="ya") {{ $aplication_file->control->finish->format('d-m-Y') }}@endif</font></td>
        </tr>
        <tr>
          <td width="375px" colspan="5" align="left" valign="top"><font size="2px"><b>16d.</b>Jumlah Jam Pemanduan<br/>{{ $aplication_file->control->control_hours }}</font></td>
        </tr>
        <tr>
          <td width="187px" colspan="2" align="left" valign="top"><font size="2px"><b>16e.</b> Nama OJTI<br/>@if ($aplication_file->control->confirm=="ya"){{ $aplication_file->control->ojti->name }}@endif</font></td>
          <td width="187px" colspan="3" align="left" valign="top"><font size="2px"><b>16f.</b> Nomor Lisensi<br/>@if ($aplication_file->control->confirm=="ya"){{ $aplication_file->control->ojti_id }}@endif</font></td>
        </tr>
        
        <tr>
          <td width="700px" colspan="8" align="left"><font size="2px"><p align="justify"><b>17.</b> Apakah anda terlibat pelanggaran yang disebabkan oleh penggunaan obat-obatan terlarang, marijuana dan obat anti depresi atau obat stimulant atau pengoperasian kendaraan bermotor dengan pengaruh alkhohol?</p><br/></font><font style="text-transform: uppercase" size="2px">{{ $aplication_file->drugs }}</font></td>
        </tr>
        <tr>
          <td width="700px" colspan="8" align="left"><font size="2px"><b>III. LATAR BELAKANG PENDIDIKAN</b></font></td>
        </tr>
        <tr>
          <td width="700px" colspan="8" align="left"><font size="2px"><b>1.</b> Jenis Pendidikan Formal</font><br/>
            @foreach ($education as $education)
            <div>
              - <font size="2px">{{ $education->formal_education->education }} Tahun <u>{{ $education->year }}</u></font>
            </div>
          @endforeach
          </td>
        <tr>
          <td width="325px" colspan="3" align="left" valign="center"><font size="2px"><b>2. Jenis Sertifikat Kompetensi</b></font></td>
          <td width="188px" colspan="3" align="center" valign="center"><font size="2px"><b>Lembaga Pelatihan</b></font></td>
          <td width="187px" colspan="2" align="center" valign="top"><font size="2px"><b>Tanggal dikeluarkan</b></font></td>
        </tr>	
        </tr>
        @foreach ($sertificate as $sertificate)
        <tr>
          <td width="325px" colspan="3" align="left" valign="center"><font size="2px"><div>- {{ $sertificate->sertificate->sertificate }}</div></li></font></td>
          <td width="188px" colspan="3" align="center" valign="center"><font size="2px">{{ $sertificate->institution }}</font></td>
          <td width="187px" colspan="2" align="center" valign="top"><font size="2px">{{ $sertificate->released->format('d-m-Y') }}</font></td>
        </tr>	
        @endforeach
        <tr>
          <td width="700px" colspan="8" align="left"><font size="2px"><b>IV. APAKAH ANDA PERNAH GAGAL UJIAN SEBELUMNYA, DALAM KURUN WAKTU 30 HARI?</b></font><br/><font style="text-transform: uppercase" size="2px">{{ $aplication_file->failed }}</font></td>
        </tr>
        <tr>
          <td width="325px" colspan="3" rowspan="3" align="left" valign="center"><font size="2px"><p align="justifly"></p><b>V. PERNYATAAN VERIFIKASI PEMOHON <br/>Saya menjamin bahwa apa yang saya tuliskan dalam form ini adalah benar</b></p></font></td>
          <td width="188px" colspan="2" align="center" valign="center"><font size="2px">Tempat dan Tanggal</font></td>
          <td width="187px" colspan="3" align="center" valign="center"><font size="2px">Tanda Tangan</font></td>
        </tr>
        <tr>
          <td width="188px" colspan="2" rowspan="2" align="center" valign="botom"><font size="12px"></font></td>
          <td width="187px" colspan="3" align="center" valign="botom" style="border: 0px;">
            <img src="data:image/svg;base64, {!! base64_encode(QrCode::format('png')->merge('/airnav.jpg')->size(100)->generate($aplication_file->user->name.'-'.$aplication_file->user_id))!!} "  class="kemenhub" alt="logo">	
          </td>
        </tr>
        <tr style="border: 0px;">
          <td width="187px" colspan="3" align="center" valign="top" style="border:0px; padding:0px;">
            <font size="2px">{{ $aplication_file->user->name }}</font>
          </td>
        </tr>
      </table>
      <iframe src="{{ Storage::url($aplication_file->license->fileUrl) }}" frameborder="0" style="width: 100%; height:600px;"></iframe>
      <iframe src="{{ Storage::url($aplication_file->logbook->fileUrl) }}" frameborder="0" style="width: 100%; height:600px"></iframe>
      
    </body> 