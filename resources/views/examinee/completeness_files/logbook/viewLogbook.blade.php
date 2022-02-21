@extends('examinee/main')

@section('title', 'Log Book')
    
@section('section-header')
<h1>Log Book's Data</h1>    
@endsection

@section('section-title')
    Datas
@endsection

@section('contain')
<a href="{{ route('logbookss.index') }}" class="btn btn-primary"> Back</a>
<div class="card">
  <div card="card-body">
    <iframe src="{{ Storage::url($logbook->fileUrl) }}" frameborder="0" style="width: 100%; height:800px"></iframe>       
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/length.js') }}"></script>
@endsection