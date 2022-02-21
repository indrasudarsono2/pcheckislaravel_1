@extends('examinee/main')

@section('title', 'Application Files')

@section('section-header')
<h1>Application Files</h1>
@endsection

@section('section-title')
Mine    
@endsection

@section('contain')
<a href="af/create" class="btn btn-primary fas fa-plus-square"> Add file</a>
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
    @if (session('warning'))
    <div class="alert alert-warning alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="success">
          <span>×</span>
        </button>
        {{ session('warning') }}
      </div>
    </div>
    @endif
      <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <td width="10px" align="center" scope="col"><b>ID</b></td>
          <td width="10px" align="center" scope="col"><b>License Number</b></td>
          <td width="100px" align="center" scope="col"><b>Name</b></td>
          <td width="50px" align="center" scope="col"><b>Remark</b></td>
          <td width="30px" align="center" scope="col"><b>Session</b></td>
          <td width="30px" align="center" scope="col"><b>Activity</b></td>
          <td width="100px" align="center" scope="col"><b>Rating</b></td>
          <td width="30px" align="center" scope="col"><b>MEDEX Exp.</b></td>
          <td width="30px" align="center" scope="col"><b>IELP Exp.</b></td>
          <td width="30px" align="center" scope="col"><b>License</b></td>
          <td width="30px" align="center" scope="col"><b>Log book</b></td>
          <td width="30px" align="center" scope="col"><b>Debriefing Date</b></td>
          <td width="20px" align="center" scope="col"><b>Status</b></td>
          <td width="100px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($aplication_file as $file)
        <tr>
          <td align="center">{{ $file->number }}</th>
          <td align="center">{{ $file->user_id }}</td>
          <td align="left">{{ $file->user->name }}</td>
          <td align="left" style="text-transform: uppercase">{{ $file->remark_ap_file->remark }}</td>
          <td align="center">{{ $file->session->year }}-{{ $file->session->period }}</td>
          <td align="center" style="text-transform: uppercase">{{ $file->activity->activity }}</td>
          <td align="left">
            @foreach ($file->form_rating as $r)
              <li>{{ $r->rating->rating }}</li>  
            @endforeach
          </td>
          <td align="center">{{ $file->medex->expired->format('d/m/Y') }}</td>
          <td align="center">{{ $file->ielp->expired->format('d/m/Y') }}</td>
          <td align="center">@if($file->license==null) No Data @else <a href="{{ route('licenses.show', $file->license->id) }}" target="_blank" rel="noopener noreferrer">{{ $file->license->comment }}</a> @endif</td>
          <td align="center">@if($file->logbook==null) No Data @else <a href="{{ route('logbooks.show', $file->logbook->id) }}" target="_blank" rel="noopener noreferrer">{{ $file->logbook->comment }}</a>@endif</td>
          <td align="center">@if($file->provision_date==null) NO DATA @else {{ $file->provision_date->format('d/m/Y H:i:s') }} @endif</td>
          <td align="center" style="text-transform: uppercase">{{ $file->status->status }}</td>
          <td align="center">
            <a href="/aplication_files/{{ $file->id }}/edit" class="btn btn-success fas fa-edit"></a>
            <form action="/aplication_files/{{ $file->id }}" method="post" class="d-inline"> 
            @method('delete')
             @csrf
            <button type="submit" class="btn btn-danger fas fa-trash" onclick="return confirm('Are you sure want to delete this data?')"> 
            </button>
            </form>
            <a href="/aplication_files/{{ $file->id }}" class="btn btn-primary fas fa-print"></a>  
            <a href="{{ route('print_checklist', $file->id) }}" class="btn btn-warning fas fa-check"></a>  
            {{-- @if ($file->remark_ap_file_id==1)
            @else
                
            @endif

            
            @if ($file->control->confirm=="ya")
            <a href="/aplication_files/{{ $file->id }}/released" class="btn btn-info fas fa-print"></a>
            @endif --}}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection