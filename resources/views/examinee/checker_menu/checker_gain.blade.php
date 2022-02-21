@extends('examinee/main')

@section('title', 'Task')

@section('section-header')
<h1>Examinee</h1>
@endsection

@section('section-title')
Member
@endsection

@section('contain')
<div class="card">
  <div class="table-responsive">
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
    @if (session('status'))
      <div class="alert alert-danger alert-dismissible show fade">
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
          <td width="50px" align="center" scope="col"><b>No</b></td>
          <td width="50px" align="center" scope="col"><b>Nomor License</b></td>
          <td width="150px" align="center" scope="col"><b>Nama</b></td>
          <td width="30px" align="center" scope="col"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        
        @for($i = 0 ; $i < count($checker_gain) ; $i++)
          <tr>
            <td width="50px" align="center" scope="col">{{ $i+1 }}</td>
            <td width="50px" align="center" scope="col">{{ $checker_gain[$i]->gain_rating->user_id }}</td>
            <td width="150px" align="left" scope="col"
              @for($j = 0 ; $j < count($pe_usr) ; $j++)
                @if($checker_gain[$i]->gain_rating->user_id == $pe_usr[$j])
                  style="background-color:#FF5D5D;"
                @break
                @endif
              @endfor
            >{{ $checker_gain[$i]->gain_rating->user->name }}</td>
            <td width="30px" align="center" scope="col">
              <a href="{{ route('checker_gains.practical_exams.index_rate_gain', [$sessionss, $checker_gain[$i]]) }}" class="btn btn-info fas fa-desktop "> PC Praktek</a>
              @if ($gr_id!=0)
                @for($l=0; $l<count($gr_id); $l++)
                  @if($checker_gain[$i]->gain_rating_id==$gr_id[$l])
                  <a href="{{ route('sessionss.checker_gains.form_ratings.index', [$sessionss, $checker_gain[$i]]) }}" class="btn btn-dark fas fa-book "> Essay</a>
                  @break
                  @endif
                @endfor 
              @endif
            </td>
          </tr>
        @endfor
        
      </tbody>
    </table>
  </div>
</div>

@endsection