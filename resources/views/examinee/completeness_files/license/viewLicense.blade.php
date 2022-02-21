@extends('examinee/main')

@section('title', 'License')
    
@section('section-header')
<h1>License's Data</h1>    
@endsection

@section('section-title')
    Datas
@endsection

@section('contain')
<a href="{{ route('licensess.index') }}" class="btn btn-primary"> Back</a>
<div class="card">
  <div card="card-body">
    @if ($extension[1]=="pdf")
        <iframe src="{{ Storage::url($license->fileUrl) }}" frameborder="0" style="width: 100%; height:600px;"></iframe>
      @else
        <img src="{{ Storage::url($license->fileUrl) }}" alt="license" style="width: 100%; height:600px;">  
      @endif        
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/length.js') }}"></script>
@endsection