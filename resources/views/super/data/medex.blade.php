@extends('super/main')

@section('title', 'Medex')

@section('section-header')
<h1>Medex</h1>
@endsection

@section('section-title')
Medex    
@endsection

@section('contain')
<input type="text" id="keyword" name="keyword" size="40" placeholder="Searching field by name">
<a href="/medex_print" class="btn btn-primary fas fa-print"> Print</a>
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
              <td width="50px" align="center" scope="col"><b>Name</b></td>
              <td width="50px" align="center" scope="col"><b>Medex Expiration</b></td>
            </tr>
          </thead>
          <tbody>
            @for($i=0; $i<$count_medex; $i++)
            <tr>
              <td align="center" style="background:">{{ $no++ }}</td>
              <td align="left">{{ $medex2[$i][0]->user->name }}</td>
              <td align="center" 
              @if ($medex2[$i][0]->expired<$three) 
              style="background:#FF6347; color:white;"
              @elseif($medex2[$i][0]->expired<$six) 
              style="background:#DAA520; color:white"
              @elseif($medex2[$i][0]->expired<$nine) 
              style="background:#228B22; color:white"
              @endif
              >{{ $medex2[$i][0]->expired->format('d F Y') }}</td>
            </tr>
            @endfor
          </tbody>
        </table>
    </div>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/findMedex.js') }}"></script>
@endsection