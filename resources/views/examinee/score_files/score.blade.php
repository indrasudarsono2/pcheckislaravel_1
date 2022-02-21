@extends('examinee/main')

@section('title', 'Score')

@section('section-header')
<h1>Score</h1>
@endsection

@section('section-title')
{{ auth()->user()->name }}`s Scores
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
    <table class="table table-hover">
      <thead>
        <tr>
          <td width="10px" align="center" scope="col" style="padding:1px"><b>No</b></td>
          <td width="30px" align="center" scope="col" style="padding:1px"><b>Aplication File ID</b></td>
          <td width="50px" align="center" scope="col"><b>Remark</b></td>
          <td width="50px" align="center" scope="col"><b>Rating</b></td>
          <td width="50px" align="center" scope="col"><b>Score</b></td>
          <td width="100px" align="center" scope="col"><b>Remark</b></td>
          <td width="20px" align="center" scope="col" style="padding:1px"><b>Action</b></td>
        </tr>
      </thead>
      <tbody>
        @for($i=0; $i<$count; $i++)
          <tr>
            <td width="50px" align="center" scope="col" rowspan="{{ count($form_rating[$i]) }}">{{ $no++ }}</td>
            <td width="50px" align="center" scope="col" rowspan="{{ count($form_rating[$i]) }}">{{ $form_rating[$i][0]->aplication_file->number }}</td>
            <td width="50px" align="center" scope="col" rowspan="{{ count($form_rating[$i]) }}">{{ $form_rating[$i][0]->aplication_file->remark_ap_file->remark }}</td>
            <td width="50px" align="center" scope="col">{{ $form_rating[$i][0]->rating->rating }}</td>
            <td width="50px" align="left" scope="col">
              @foreach ($form_rating[$i][0]->score as $score)
                @if ($score==null)
                  No data
                @else
                  <li style="list-style-type: none;">{{$loop->iteration}}). {{ $score->score }}</li>
                @endif
              @endforeach
            </td>
            <td width="50px" align="left" scope="col">
              @foreach ($form_rating[$i][0]->score as $score)
                @if ($score==null)
                  No data
                @else
                  <li style="list-style-type: none;">{{$loop->iteration}}). {{ $score->remark_score->remark }}</li>
                @endif
              @endforeach
            </td>
            <td width="50px" align="center" scope="col">
              @foreach ($form_rating[$i][0]->score as $score)
                @if ($score==null)
                  No data
                @else
                  @if($score->remark_score_id !=1 && $score->remark_score_id!=2)
                    <a href="{{ route('scores.edit', $score) }}" class="badge badge-primary fas fa-print"> {{ $loop->iteration }}</a> 
                  @endif
                @endif  
              @endforeach
            </td>
          </tr>
          @if(count($form_rating[$i])>1)
            @for($j=1; $j<$count_fr[$i]; $j++)
              <tr>
                <td  align="center">{{ $form_rating[$i][$j]->rating->rating }}</td>
                <td width="50px" align="left" scope="col">
                  @foreach ($form_rating[$i][$j]->score as $score)
                    @if ($score==null)
                      No data
                    @else
                      <li style="list-style-type: none;">{{$loop->iteration}}). {{ $score->score }}</li>
                    @endif
                  @endforeach
                </td>
                <td width="50px" align="left" scope="col">
                  @foreach ($form_rating[$i][$j]->score as $score)
                    @if ($score==null)
                      No data
                    @else
                      <li style="list-style-type: none;">{{$loop->iteration}}). {{ $score->remark_score->remark }}</li>
                    @endif
                  @endforeach
                </td>
                <td width="50px" align="center" scope="col">
                  @foreach ($form_rating[$i][$j]->score as $score)
                    @if ($score==null)
                      No data
                    @else
                      <a href="{{ route('scores.edit', $score) }}" class="badge badge-primary fas fa-print"> {{ $loop->iteration }}</a> 
                    @endif
                  @endforeach
                </td>
              </tr>
            @endfor
          @endif
        @endfor
      </tbody>
    </table>
  </div>
</div>

@endsection