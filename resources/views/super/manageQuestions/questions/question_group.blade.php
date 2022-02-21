@extends('super/main')

@section('title', 'Show Group')

@section('section-header')
<h1>Show {{ $aplication_rating->rating->rating }}'s Group</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ route('aplication_ratings.index') }}">Type of Question</a></div>
</div> 
@endsection

@section('section-title')
{{ $aplication_rating->rating->rating }}'s Group    
@endsection

@section('contain')
<a href="{{ route('aplication_ratings.question_groups.create', $aplication_rating) }}" class="btn btn-primary fas fa-plus-square"> Add Group</a>
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
    <div id="container">
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <td width="10px" align="center" scope="col"><b>No</b></td>
            <td width="10px" align="center" scope="col"><b>Group</b></td>
            <td width="10px" align="center" scope="col"><b>Quantity</b></td>
            <td width="150px" align="center" scope="col"><b>Action</b></td>
          </tr>
          
        </thead>
        <tbody>
          @for($i=0;$i<count($question_group);$i++)
            <tr>
              <td align="center">{{ $no++ }}</th>
              <td align="center">{{ $question_group[$i]->group }}</td>
              <td align="center" @if($question_group[$i]->quantity > $count[$i]) style="background: #ff4f4f; color:white;" @endif>{{ $question_group[$i]->quantity }}</td>
              <td align="center">
                <a href="{{ route('aplication_ratings.question_groups.edit', [$aplication_rating, $question_group[$i]]) }}" class="btn btn-success fas fa-edit"></a>
                <form action="{{ route('aplication_ratings.question_groups.destroy', [$aplication_rating, $question_group[$i]]) }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf
                <button type="submit" class="btn btn-danger fas fa-trash" onclick="return confirm('Are you sure want to delete this data?')"> 
                </button>
                </form>
              </td>
            </tr>
          @endfor
          <tr>
            <td colspan="2" align="center">Total</td>
            <td align="center">{{ $quantity }}</td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/findAcsQuestion.js') }}"></script>
@endsection