@extends('examinee/main')

@section('title', 'Practical Exam')

@section('section-header')
<h1>Practical Exam</h1>
@endsection

@section('section-title')
{{ auth()->user()->name }}
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
          <td width="50px" align="center" scope="col"><b>No</b></td>
          <td width="50px" align="center" scope="col"><b>Aplication File ID</b></td>
          <td width="50px" align="center" scope="col"><b>Remark</b></td>
          <td width="50px" align="center" scope="col"><b>Rating</b></td>
          <td width="50px" align="center" scope="col"><b>Checker Name (Score)</b></td>
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
              @foreach ($form_rating[$i][0]->practical_exam as $practical_exam)
                  @if ($practical_exam->checker_gain_id!=null)
                    <li style="list-style-type: none">{{ $practical_exam->checker_gain->user->name }} (<b>{{ $practical_exam->score }}</b>)</li>  
                  @else
                    <li style="list-style-type: none">{{ $practical_exam->group->user->name }} (<b>{{ $practical_exam->score }}</b>)</li>
                  @endif
              @endforeach
            </td>
          </tr>
          @if(count($form_rating[$i])>1)
            @for($j=1; $j<$count_fr[$i]; $j++)
              <tr>
                <td  align="center">{{ $form_rating[$i][$j]->rating->rating }}</td>
                <td width="50px" align="left" scope="col">
                  @foreach ($form_rating[$i][$j]->practical_exam as $practical_exam)
                      @if ($practical_exam->checker_gain_id!=null)
                        <li style="list-style-type: none">{{ $practical_exam->checker_gain->user->name }} (<b>{{ $practical_exam->score }}</b>)</li>  
                      @else
                      <li style="list-style-type: none">{{ $practical_exam->group->user->name }} (<b>{{ $practical_exam->score }}</b>)</li>
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