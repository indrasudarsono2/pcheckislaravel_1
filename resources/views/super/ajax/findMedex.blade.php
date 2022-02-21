<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <td width="10px" align="center" scope="col"><b>No</b></td>
      <td width="50px" align="center" scope="col"><b>Name</b></td>
      <td width="50px" align="center" scope="col"><b>Medex Expiration</b></td>
    </tr>
  </thead>
  <tbody>
    @for($i=0; $i<$count_medex; $i++)
    <tr>
      <td align="center" style="background:">{{ $no++ }}</td>
      <td align="left">{{ $medex2[$i][0]->user->name }}</td>
      <td align="center" 
      @if ($medex2[$i][0]->expired<$three) 
      style="background:#FF6347; color:white;"
      @elseif($medex2[$i][0]->expired<$six) 
      style="background:#DAA520; color:white"
      @elseif($medex2[$i][0]->expired<$nine) 
      style="background:#228B22; color:white"
      @endif
      >{{ $medex2[$i][0]->expired->format('d F Y') }}</td>
    </tr>
    @endfor
  </tbody>
</table>