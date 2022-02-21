@extends('super/main')

@section('title', 'Debriefing')

@section('section-header')
<h1>Debriefing</h1>
@endsection

@section('section-title')
Debriefing    
@endsection

@section('contain')
@if ($provision->isEmpty())
<a href="{{ route('provisions.create') }}" class="btn btn-primary fas fa-plus-square"> Add Debriefing</a>
@endif
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
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <td width="10px" align="center" scope="col"><b>No</b></td>
          <td width="50px" align="center" scope="col"><b>Token</b></td>
          <td width="50px" align="center" scope="col"><b>Validity</b></td>
          <td width="50px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @foreach ($provision as $provision)
        <tr>
          <td align="center">{{ $loop->iteration }}</td>
          <td align="center">{{ $provision->token }}</td>
          <td align="center">{{ $provision->validity->format('d F Y H:i:s') }}</td>
          <td align="center">
            <a href="{{ route('provisions.edit', $provision) }}" class="btn btn-success fas fa-edit"></a>
          </td>
          
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection