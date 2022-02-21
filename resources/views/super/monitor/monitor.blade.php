@extends('super/main')

@section('title', 'Rating')

@section('section-header')
<h1>Rating</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ url('/session_monitor') }}">Monitor</a></div>
  <div class="breadcrumb-item active"><a href="{{ route('sessions.remark_ap_files.index_session', $session) }}">Remark</a></div>
  <div class="breadcrumb-item active"><a href="{{ route('sessions.remark_ap_files.aplication_ratings.index_session', [$session, $remark_ap_file]) }}">Rating</a></div>
</div> 
@endsection

@section('section-title')
Rating {{ $aplication_rating->rating->rating }}  
@endsection

@section('contain')
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
<style>
  	table {
			border-collapse: collapse;
		}

		table,
		th,
		td
    {
			border: 1px solid black;
		}

		th, td {
            padding: 5px;
        }
</style>
<div class="card">
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <td width="10px" align="center" scope="col" rowspan="2"><b>No</b></td>
          <td width="50px" align="center" scope="col" rowspan="2"><b>Name</b></td>
          <td width="50px" align="center" scope="col" rowspan="2"><b>Control Hours</b></td>
          <td width="50px" align="center" scope="col" rowspan="2"><b>Status</b></td>
          <td width="50px" align="center" scope="col" colspan="2"><b>Practical Exam</b></td>
          @if(Auth::user()->remark_id==1)<td width="10px" align="center" scope="col" rowspan="2"><b>Action</b></td> @endif
        </tr>
        <tr>
          <td width="50px" align="center" scope="col"><b>Checker Name</b></td>
          <td width="50px" align="center" scope="col"><b>Practical Score</b></td>
        </tr>
      </thead>
      <tbody>
        @for($i = 0 ; $i < count($form_rating) ; $i++)
          <tr>
            <td align="center" rowspan="{{count($form_rating[$i]->practical_exam)}}">{{ $i+1 }}</td>
            <td align="left" rowspan="{{count($form_rating[$i]->practical_exam)}}">{{ $form_rating[$i]->aplication_file->user->name }}</td>
            <td align="center" rowspan="{{count($form_rating[$i]->practical_exam)}}">{{ $form_rating[$i]->control_hours }}</td>
            <td align="center" rowspan="{{count($form_rating[$i]->practical_exam)}}" @if($form_rating[$i]->status_id==3) style="background: #ADFF2F" @endif>{{ $form_rating[$i]->status->status }}</td>
            <td align="left">
              @for($j = 0 ; $j < count($form_rating[$i]->practical_exam) ; $j++)
                <li style="list-style-type: none">{{ $form_rating[$i]->practical_exam[0]->user->name }}</li>
                @break
              @endfor
              {{-- @foreach ($form_rating[$i]->practical_exam as $practical_exam)
                  <li style="list-style-type: none">{{ $practical_exam->user->name }}</li>
              @endforeach --}}
            </td>
            <td align="center">
              @for($k = 0 ; $k < count($form_rating[$i]->practical_exam) ; $k++)
                <li style="list-style-type: none">{{ $form_rating[$i]->practical_exam[0]->score }}</li>
                @break
              @endfor
              {{-- @foreach ($form_rating[$i]->practical_exam[0] as $practical_exam)
                  <li style="list-style-type: none">{{ $practical_exam->score }}</li>
              @endforeach --}}
            </td>
            @if(Auth::user()->remark_id==1) 
              <td align="center" rowspan="{{count($form_rating[$i]->practical_exam)}}">
                <a href="{{ route('editPracticalExam', [$session, $remark_ap_file, $aplication_rating, $form_rating[$i]]) }}" class="btn btn-success fas fa-edit"> Edit</a>
              </td>
            @endif
          </tr>
          @if(count($form_rating[$i]->practical_exam)>1)
            @for($k = 1 ; $k < count($form_rating[$i]->practical_exam) ; $k++)
              <tr>
                <td align="left">
                  <li style="list-style-type: none">{{ $form_rating[$i]->practical_exam[$k]->user->name }}</li>
                </td>
                <td align="center">
                  <li style="list-style-type: none">{{ $form_rating[$i]->practical_exam[$k]->score }}</li>
                </td>
              </tr>
            @endfor
          @endif
        @endfor
      </tbody>
    </table>
  </div>
</div>

@endsection