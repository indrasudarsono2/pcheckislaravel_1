@extends('super/main')

@section('title', 'Gaining Rating')

@section('section-header')
<h1>Gaining Rating</h1>
@endsection

@section('section-title')
Gaining Rating    
@endsection

@section('contain')
<a href="{{ route('printTable', $session) }}" class="btn btn-primary fas fa-print"> Print</a>
<div class="card">
  <div class="table-responsive">
    <table class="table-hover">
      @for($h=1; $h<=$ceil;$h++)
        <tr>
          @for($i=(($h*5)-5); $i<(5*$h); $i++)
            @if ($i==$count)
                @break
            @else
              <td width="250px" align="center" scope="col" style="border: 1px solid black"><b>{{ $gain_name[$i] }}</b></td>
            @endif
          @endfor
        </tr>
       
        <tbody>
          <tr>
            @for($i=(($h*5)-5); $i<(5*$h); $i++)
              @if ($i==$count)
                @break
              @else
                <td width="250px" align="left" valign="top" scope="col" style="border: 1px solid black">
                  @for($j=0; $j<count($checker_gain[$i]); $j++)
                  {{$j+1}}. {{ $checker_gain[$i][$j]->user->name }} <br/>
                  @endfor
              </td>
              @endif
            @endfor
          </tr>
        </tbody>
      @endfor
    </table>
  </div>
</div>

@endsection