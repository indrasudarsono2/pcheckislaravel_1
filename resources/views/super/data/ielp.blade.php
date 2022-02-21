@extends('super/main')

@section('title', 'IELP')

@section('section-header')
<h1>IELP</h1>
@endsection

@section('section-title')
IELP    
@endsection

@section('contain')
<input type="text" id="keyword" name="keyword" size="40" placeholder="Searching field by name">
<a href="/ielp_print" class="btn btn-primary fas fa-print"> Print</a>
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
              <td width="50px" align="center" scope="col"><b>IELP Expiration</b></td>
            </tr>
          </thead>
          <tbody>
            @for($i=0; $i<$count_ielp; $i++)
            <tr>
              <td align="center" style="background:">{{ $no++ }}</td>
              <td align="left">{{ $ielp2[$i][0]->user->name }}</td>
              <td align="center" 
              @if ($ielp2[$i][0]->expired<$three) 
              style="background:#FF6347; color:white;"
              @elseif($ielp2[$i][0]->expired<$six) 
              style="background:#DAA520; color:white"
              @elseif($ielp2[$i][0]->expired<$nine) 
              style="background:#228B22; color:white"
              @endif
              >{{ $ielp2[$i][0]->expired->format('d F Y') }}</td>
            </tr>
            @endfor
          </tbody>
        </table>
    </div>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/findIelp.js') }}"></script>
@endsection