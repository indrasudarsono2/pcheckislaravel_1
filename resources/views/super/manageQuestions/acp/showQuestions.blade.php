@extends('super/main')

@section('title', 'Show Question')

@section('section-header')
<h1>Show ACP's Question</h1>
@endsection

@section('section-title')
ACP's Question    
@endsection

@section('contain')
<a href="acp_questions/create" class="btn btn-primary fas fa-plus-square"> Add question</a>
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
          @foreach ($acp_question as $question)
          <tr>
            <td align="center">{{ $question->id }}</th>
            <td align="center">{{ $question->group }}</td>
            <td align="left">{{ $question->question }}</td>
            <td align="left">{{ $question->a }}</td>
            <td align="left">{{ $question->b }}</td>
            <td align="left">{{ $question->c }}</td>
            <td align="left">{{ $question->d }}</td>
            <td align="center">{{ $question->key }}</td>
            <td align="center">
              <a href="/acp_questions/{{ $question->id }}/edit" class="btn btn-success fas fa-edit"></a>
              <form action="/acp_questions/{{ $question->id }}" method="post" class="d-inline">
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
    </div>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/findAcpQuestion.js') }}"></script>
@endsection