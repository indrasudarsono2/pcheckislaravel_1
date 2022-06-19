@extends('examinee/main')

@section('title', 'Group Member')

@section('section-header')
<h1>Group Member</h1>
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
      <div class="alert alert-success alert-dismissible show fade">
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
        @for($h = 0 ; $h < count($group_member) ; $h++)       
        <tr>
          <td width="50px" align="center" scope="col">{{ $h+1 }}</td>
          <td width="50px" align="center" scope="col">{{ $group_member[$h]->user_id }}</td>
          <td width="150px" align="left" scope="col"
            @for($j = 0 ; $j < count($pe_usr) ; $j++)
              @if($group_member[$h]->user_id == $pe_usr[$j])
                style="background-color:#FF5D5D;"
              @break
              @endif
            @endfor
          >{{ $group_member[$h]->user->name }}</td>
          <td width="30px" align="center" scope="col">
            @if ($af!=null)
              @for($d=0; $d<count($af); $d++)
                @if($af[$d]->user_id == $group_member[$h]->user_id)
                  @for($e=0; $e<count($frm_userid); $e++)
                    @if ($group_member[$h]->user_id == $frm_userid[$e])
                      <a href="{{ route('group_members.practical_exams.index_rate_member', [$sessionss, $group_member[$h]]) }}" class="btn btn-info fas fa-desktop "> PC Praktek</a>
                    @break
                    {{-- @else
                      BELOM MENGERJAKAN --}}
                    @endif
                  @endfor
                @endif
              @endfor

              @if ($gm_id!=0)
                @for($i=0; $i<count($gm_id); $i++)
                  @if($group_member[$h]->id == $gm_id[$i])
                  <a href="{{ route('sessionss.group_members.form_ratings.create', [$sessionss, $group_member[$h]]) }}" class="btn btn-dark fas fa-book "> Essay</a>
                  @break
                  @endif
                @endfor 
              @endif
              <a href="{{ route('sessionss.group_members.show', [$sessionss, $group_member[$h]]) }}" class="btn btn-primary fas fa-certificate"> Score</a>
            @endif
          </td>
        </tr>
        @endfor
      </tbody>
    </table>
  </div>
</div>

@endsection