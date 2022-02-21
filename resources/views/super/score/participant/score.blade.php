@extends('super/main')

@section('title', 'Score ')

@section('section-header')
<h1>Score </h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ route('user_scores') }}">Participant</a></div>
  <div class="breadcrumb-item active"><a href="{{ route('user.session.user_sesion', $user) }}">{{ $user->name }}</a></div>
</div> 
@endsection

@section('section-title')
Score     
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
    <div id="container">
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <td width="10px" align="center" scope="col"><b>No</b></td>
            <td width="10px" align="center" scope="col"><b>Tanggal</b></td>
            <td width="50px" align="center" scope="col"><b>Name</b></td>
            <td width="50px" align="center" scope="col"><b>Score</b></td>
            <td width="50px" align="center" scope="col"><b>Remark</b></td>
            <td width="50px" align="center" scope="col"><b>Action</b></td>
          </tr>
        </thead>
        <tbody>
          @foreach ($score as $score)
          <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="center">{{ $score->updated_at->format('d-m-Y') }}</td>
            <td align="left">{{ $score->form_rating->aplication_file->user->name }}</td>
            <td align="center">{{ $score->score }}</td>
            <td align="center">{{ $score->remark_score->remark }}</td>
            <td align="center">
              <a href="{{ route('user.session.user_sesion.score.print', [$user, $aplication_file, $score]) }}" class="btn btn-info fas fa-print"> Print</a>
            @if(Auth::user()->remark_id==1)
              <a href="{{ route('user.session.user_sesion.score.result', [$user, $aplication_file, $score]) }}" class="btn btn-primary fas fa-print"> Result</a>   
            @endif  
            </td>
            
          </tr>
  
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection