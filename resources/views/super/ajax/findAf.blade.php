<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <td width="10px" align="center" scope="col"><b>Number</b></td>
      <td width="10px" align="center" scope="col"><b>Remark</b></td>
      <td width="50px" align="center" scope="col"><b>Name</b></td>
      <td width="50px" align="center" scope="col"><b>Rating</b></td>
      <td width="50px" align="center" scope="col"><b>IELP</b></td>
      <td width="50px" align="center" scope="col"><b>Medex</b></td>
      <td width="50px" align="center" scope="col"><b>Document</b></td>
      <td width="50px" align="center" scope="col"><b>Debriefing Date</b></td>
      <td width="10px" align="center" scope="col"><b>Action</b></td>
    </tr>
  </thead>
  <tbody>
    @for($i = 0 ; $i < count($aplication_file) ; $i++)
    <tr>
      <td align="center">{{ $aplication_file[$i]->number }}</td>
      <td align="center">{{ $aplication_file[$i]->remark_ap_file->remark }}</td>
      <td align="left">{{ $aplication_file[$i]->user->name }}</td>
      <td align="center">
                @foreach ($aplication_file[$i]->form_rating as $r)
                    <li>{{ $r->rating->rating }}</li>  
                @endforeach
              </td>
      <td align="center">{{ $aplication_file[$i]->ielp->expired->format('d F Y') }}</td>
      <td align="center">{{ $aplication_file[$i]->medex->expired->format('d F Y') }}</td>
      <td align="center">
        @if ($aplication_file[$i]->license_id == null || $aplication_file[$i]->logbook_id == null)
          No Data
        @else
          <a href="{{ route('viewDocumentSuper', [$session, $remark_ap_file, $aplication_file[$i]]) }}" class="fas fa-eye" target="_blank"> See</a>
        @endif
      </td>
      <td align="center">@if($aplication_file[$i]->provision_date==null) NO DATA @else {{ $aplication_file[$i]->provision_date->format('d F Y H:i:s') }}@endif</td>
      <td align="center">
      <a href="{{ route('sessions.remark_ap_files.aplication_files.edit', [$session, $remark_ap_file, $aplication_file[$i]]) }}" class="btn btn-primary fas fa-print"> Print</a>
        @for($j = 0 ; $j < count($verification_data) ; $j++)
          @if ($aplication_file[$i]->id == $verification_data[$j][0]->aplication_file_id)
              <a href="{{ route('printChecklist_admin', [$session, $remark_ap_file, $aplication_file[$i]]) }}" class="btn btn-warning fas fa-check"></a>
          @endif
        @endfor
      </td>
    </tr>
    @endfor
  </tbody>
</table>
