@extends('super/main')

@section('title', 'Show Question')

@section('section-header')
<h1>Show {{ $aplication_rating->rating->rating }}'s Questions</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ route('aplication_ratings.index') }}">Type of Question</a></div>
</div> 
@endsection

@section('section-title')
{{ $aplication_rating->rating->rating }}'s Questions    
@endsection

@section('contain')
<a href="{{ route('aplication_ratings.mc_questions.create', $aplication_rating) }}" class="btn btn-primary fas fa-plus-square"> Add question</a>
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
    <div id="container">
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <td width="10px" align="center" scope="col"><b>No</b></td>
            <td width="10px" align="center" scope="col"><b>ID</b></td>
            <td width="10px" align="center" scope="col"><b>Group</b></td>
            <td width="200px" align="center" scope="col"><b>Question</b></td>
            <td width="200px" align="center" scope="col"><b>A</b></td>
            <td width="200px" align="center" scope="col"><b>B</b></td>
            <td width="200px" align="center" scope="col"><b>C</b></td>
            <td width="200px" align="center" scope="col"><b>D</b></td>
            <td width="10px" align="center" scope="col"><b>Key</b></td>
            <td width="150px" align="center" scope="col"><b>Action</b></td>
          </tr>
        </thead>
        <tbody>
          @foreach ($mc_question as $mc)
          <tr>
            <td align="center">{{ $mc_question->firstItem()+$loop->iteration-1 }}</th>
            <td align="center">{{ $mc->id }}</th>
            @if($mc->question_group_id=="")
              <td align="center"></td>            
            @else
              <td align="center">{{ $mc->question_group->group }}</td>
            @endif
            <td align="left">{{ $mc->question }}</td>
            <td align="left">{{ $mc->a }}</td>
            <td align="left">{{ $mc->b }}</td>
            <td align="left">{{ $mc->c }}</td>
            <td align="left">{{ $mc->d }}</td>
            <td align="center">{{ $mc->key }}</td>
            <td align="center">
              <a href="{{ route('aplication_ratings.mc_questions.edit', [$aplication_rating, $mc]) }}" class="btn btn-success fas fa-edit"></a>
              <form action="{{ route('aplication_ratings.mc_questions.destroy', [$aplication_rating, $mc]) }}" method="post" class="d-inline">
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
      
	{{ $mc_question->links() }}
    </div>
   </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/findQuestion.js') }}"></script>
@endsection