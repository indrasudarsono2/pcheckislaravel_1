@extends('examinee/main')

@section('title', 'Aplication Files')

@section('section-header')
<h1>Aplication Files</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ route('sessionss.index') }}">Session</a></div>
  <div class="breadcrumb-item active"><a href="{{ route('sessionss.remark_ap_files.index', $sessionss) }}">Remark</a></div>
</div>
@endsection

@section('section-title')
Files
@endsection

@section('contain')
<div class="card">
  <div class="table-responsive">
    @if (session('status'))
      <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="success">
            <span>×</span>
          </button>
          {{ session('status') }}
        </div>
      </div>
    @endif
    @if (session('alert'))
      <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="success">
            <span>×</span>
          </button>
          {{ session('alert') }}
        </div>
      </div>
    @endif
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <td width="10px" align="center" scope="col"><b>ID</b></td>
          <td width="50px" align="center" scope="col"><b>Nama</b></td>
          <td width="50px" align="center" scope="col"><b>Ielp</b></td>
          <td width="50px" align="center" scope="col"><b>Medex</b></td>
          <td width="50px" align="center" scope="col"><b>Rating</b></td>
          <td width="50px" align="center" scope="col"><b>Control Hours</b></td>
          <td width="50px" align="center" scope="col"><b>Document</b></td>
          <td width="50px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @for($i = 0 ; $i < count($aplication_file) ; $i++)
          <tr>
            <td align="center">{{ $aplication_file[$i]->number }}</td>
            <td align="left">{{ $aplication_file[$i]->user->name }}</td>
            <td align="center">{{ $aplication_file[$i]->ielp->expired->format('d F Y') }}</td>
            <td align="center">{{ $aplication_file[$i]->medex->expired->format('d F Y') }}</td>
            <td align="center">
              @foreach($aplication_file[$i]->form_rating as $form_rating)
              <li>{{ $form_rating->rating->rating }}</li>
              @endforeach
            </td>
            <td align="center">
              @foreach($aplication_file[$i]->form_rating as $form_rating)
              <li>{{ $form_rating->control_hours }}</li>
              @endforeach
            </td>
            <td align="center">
              @if ($aplication_file[$i]->license_id == null || $aplication_file[$i]->logbook_id == null)
                No Data
              @else
                <a href="{{ route('viewDocument', [$sessionss, $remark_ap_file, $aplication_file[$i]]) }}" class="fas fa-eye" target="_blank" rel="noopener noreferrer"> See</a>
              @endif
            </td>
            <td align="center">
              @if($aplication_file[$i]->status_id==1)
                {{-- <form action="{{ route('aplication_file.verification_proses', [$sessionss, $remark_ap_file, $aplication_file[$i]]) }}" method="GET">
                  @csrf
                  <button class="btn btn-primary fas fa-edit" onclick="return confirm('Are you sure want to verify {{ $aplication_file[$i]->user->name }}`s file?')"> Verified</button>
                </form> --}}
                <a class="btn btn-primary" href="{{ route('verification_data', [$sessionss, $remark_ap_file, $aplication_file[$i]]) }}">Verify Data</a>
              @else
                VERIFIED  
              @endif
              @for($j = 0 ; $j < count($verification_data) ; $j++)
                @if ($aplication_file[$i]->id == $verification_data[$j][0]->aplication_file_id)
                  <a href="{{ route('print_checklist_checker', [$sessionss, $remark_ap_file, $aplication_file[$i]]) }}" class="btn btn-warning fas fa-check"></a>
                @endif
              @endfor
            </td>
          </tr>
        @endfor
      </tbody>
    </table>
  </div>
  
</div>
@endsection