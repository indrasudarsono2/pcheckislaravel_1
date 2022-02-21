@extends('super/main')

@section('title', 'Question_varian')

@section('section-header')
<h1>Question_varian</h1>
@endsection

@section('section-title')
Question
@endsection

@section('contain')
<a href="{{ route('aplication_ratings.performance_checks.create', $aplication_rating) }}" class="btn btn-primary fas fa-plus-square"> Add varian</a>
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
          <td width="10px" align="center" scope="col"><b>No</b></td>
          <td width="50px" align="center" scope="col"><b>Varian</b></td>
          <td width="50px" align="center" scope="col"><b>Quantity</b></td>
          <td width="50px" align="center" scope="col"><b>Persentage</b></td>
          <td width="50px" align="center" scope="col"><b>Minute</b></td>
          <td width="30px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($performance_check as $performance_check)
        <tr>
          <td width="50px" align="center" scope="col">{{ $loop->iteration }}</td>
          <td width="50px" align="center" scope="col">{{ $performance_check->question_varian->varian }}</td>
          <td width="50px" align="center" scope="col" @if ($performance_check->question_varian_id==2) @if($quantity_mc!=$performance_check->quantity) style="background: #ff4f4f; color:white;" @endif @else @if($performance_check->quantity>$count_essay) style="background: #ff4f4f; color:white;" @endif @endif>{{ $performance_check->quantity }}</td>
          <td width="50px" align="center" scope="col">{{ $performance_check->persentage }}</td>
          <td width="50px" align="center" scope="col">{{ $performance_check->minute }} minutes</td>
          <td width="30px" align="center" scope="col">
            <a href="{{ route('aplication_ratings.performance_checks.edit', [$aplication_rating, $performance_check]) }}" class="btn btn-success fas fa-edit"></a>
            <form action="{{ route('aplication_ratings.performance_checks.destroy', [$aplication_rating, $performance_check]) }}" method="post" class="d-inline">
              @method('delete')
              @csrf
              <button type="submit" class="btn btn-danger fas fa-trash" onclick="return confirm('Are you sure want to delete this data?')"> 
              </button>
            </form>
          </td>
        </tr>
        @endforeach
        <tr>
          <td colspan="3" align="center">Persentage total</td>
          <td align="center" @if ($persentage_total!=1) style="background: #ff4f4f" @endif>{{$persentage_total}}</td>
          
        </tr>
      </tbody>
    </table>
  </div>
</div>

@endsection