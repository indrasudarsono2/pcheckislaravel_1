@extends('super/main')

@section('title', 'Show Essay')

@section('section-header')
<h1>Show {{ $aplication_rating->rating->rating }} Essays</h1>
@endsection

@section('section-title')
Essays    
@endsection

@section('contain')
<a href="{{ route('aplication_ratings.essays.create', $aplication_rating) }}" class="btn btn-primary fas fa-plus-square"> Add essay</a>
<br>
<br>
<input type="text" id="keyword" name="keyword" size="40" placeholder="Searching by anything">
<img src="{{ asset('img/loader.gif') }}" class="loader">
<br>
<br>
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
    <div id="container">
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <td width="10px" align="center" scope="col"><b>No</b></td>
            <td width="10px" align="center" scope="col"><b>ID</b></td>
            <td width="10px" align="center" scope="col"><b>Group</b></td>
            <td width="200px" align="center" scope="col"><b>Essay</b></td>
            <td width="200px" align="center" scope="col"><b>Answer</b></td>
            <td width="10px" align="center" scope="col"><b>Score</b></td>
            <td width="50px" align="center" scope="col"><b>Action</b></td>
          </tr>
        </thead>
        <tbody>
          @foreach ($essay as $ess)
          <tr>
            <td align="center">{{ $essay->firstItem()+$loop->iteration-1 }}</th>
            <td align="center">{{ $ess->id }}</th>
            @if($ess->essay_group_id=="")
              <td align="center"></td>            
            @else
              <td align="center">{{ $ess->essay_group->group }}</td>
            @endif
            <td align="left">{{ $ess->essay }}</td>
            <td align="left">{{ $ess->answer }}</td>
            <td align="center">{{ $ess->score }}</td>
            <td align="center">
              <a href="{{ route('aplication_ratings.essays.edit', [$aplication_rating,$ess]) }}" class="btn btn-success fas fa-edit"></a>
              <form action="{{ route('aplication_ratings.essays.destroy', [$aplication_rating, $ess]) }}" method="post" class="d-inline">
                @method('delete')
                @csrf
              <button type="submit" class="btn btn-danger fas fa-trash" onclick="return confirm('Are you sure want to delete this data?')"> 
              </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $essay->links() }}
    </div>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/findEssay.js') }}"></script>
@endsection