@extends('super/main')

@section('title', 'Application Files')

@section('section-header')
<h1>Application Files</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ route('sessions_history') }}">{{ $session->year }}-{{ $session->period }}</a></div>
  <div class="breadcrumb-item active"><a href="{{ route('sessions.remark_ap_files.create', $session) }}">{{ $remark_ap_file->remark }}</a></div>
</div>
@endsection

@section('section-title')
Application Files
@endsection

@section('contain')

<div class="row">
  <div class="col-md-4">
    <input type="text" id="keyword" name="keyword" size="40" placeholder="Searching field by name">
  </div>
  <div class="col-md-4"  id="border">
    <form method="post" action="{{ route('sessions.remark_ap_files.aplication_files.store', [$session, $remark_ap_file]) }}">
      @csrf
      <input type="date" name="start">
      <input type="date" name="end">
      <button type="submit" class="btn btn-primary fas fa-print"> Debriefing Attendace</button>
    </form>
  </div>
  <div class="col-md-4"  id="border">
    <form method="post" action="{{ route('sessions.remark_ap_files.printAll', [$session, $remark_ap_file]) }}">
      @csrf
      <input type="date" name="start">
      <input type="date" name="end">
      <button type="submit" class="btn btn-info fas fa-print"> Print All</button>
    </form>
  </div>
</div>
<div class="card">
    <div id="container">
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
                <td align="left">
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
        {{ $aplication_file->links() }}
      </div>
    </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/findAf.js') }}"></script>
@endsection