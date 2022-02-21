@extends('examinee/main')

@section('title', 'Performance Check')

@section('section-header')
<h1>Performance Check {{ $aplication_rating->rating->rating }}</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ route('files') }}">Check</a></div>
</div>
@endsection

@section('section-title')
Overview
@endsection

@section('contain')
<div class="card">
  <div class="table-responsive">
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
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <td width="30px" align="center" scope="col"><b>No</b></td>
          <td width="50px" align="center" scope="col"><b>Varian</b></td>
          <td width="50px" align="center" scope="col"><b>Quantity</b></td>
          <td width="30px" align="center" scope="col"><b>Persentage</b></td>
          <td width="30px" align="center" scope="col"><b>Minute</b></td>
          <td width="30px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($performance_check as $performance_check)
        <tr>
          <td width="30px" align="center" scope="col">{{ $loop->iteration }}</td>
          <td width="50px" align="center" scope="col">{{ $performance_check->question_varian->varian }}</td>
          <td width="50px" align="center" scope="col">{{ $performance_check->quantity }}</td>
          <td width="30px" align="center" scope="col">{{ $performance_check->persentage }}</td>
          <td width="30px" align="center" scope="col">{{ $performance_check->minute }}</td>
          <td width="30px" align="center" scope="col">
          @if($performance_check->question_varian_id == 1)
            @if($score==null || $score->remark_score_id == 3 )
              <a href="{{ route('form_ratings.performance_checks.question_varians.index', [$form_rating, $performance_check]) }}" class="btn btn-info fas fa-play-circle "> Start</a>
            @endif
          @endif
          @if($performance_check->question_varian_id == 2)
            @if($count_pc==1)
              <a href="{{ route('form_ratings.performance_checks.question_varians.index', [$form_rating, $performance_check]) }}" class="btn btn-info fas fa-play-circle "> Start</a>
            @endif
            @if($count_pc>1)
              @if($score!=null && $score->remark_score_id == 2)
                <a href="{{ route('form_ratings.performance_checks.question_varians.index', [$form_rating, $performance_check]) }}" class="btn btn-info fas fa-play-circle "> Start</a>
              @endif
            @endif
          @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection