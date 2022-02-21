@extends('examinee/main')

@section('title', 'Aplication Files')

@section('section-header')
<h1>Aplication Files</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ route('sessionss.index') }}">Session</a></div>
  <div class="breadcrumb-item active"><a href="{{ route('sessionss.remark_ap_files.index', $sessionss) }}">Remark</a></div>
  <div class="breadcrumb-item active"><a href="{{ route('aplication_file.verification', [$sessionss, $remark_ap_file]) }}">Aplication Files</a></div>
</div>
@endsection

@section('section-title')
Verification Data
@endsection

@section('contain')
<a class="btn btn-info" href="{{ route('aplication_file.verification', [$sessionss, $remark_ap_file]) }}">Back</a>
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
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <td align="center">No</td>
        <td align="center">Persyaratan</td>
        <td align="center">Status</td>
        <td align="center">Kesesuaian</td>
        <td align="center">Keterangan</td>
      </thead>
      <tbody>
        <form id="mc_question" name="frmupload" action="{{ route('aplication_file.verification_proses', [$sessionss, $remark_ap_file, $aplication_file]) }}" method="post">
          @csrf
        @for($i = 0 ; $i < $count ; $i++)
          @if($remark_ap_file->id==2 && $i==5)
            @continue
          @else
            <tr class="radio">
              <td align="center">{{ $no++ }}</td>
              <td align="left">
                {{ $verification_item[$i]->item }}
                @if($i==3)<br/>@foreach($aplication_file->form_rating as $rating) <li>{{ $rating->rating->full }}</li>@endforeach 
                @elseif($i+1 == count($verification_item)) <br/>@foreach($aplication_file->form_rating as $rating) <li>{{ $rating->rating->full }} : {{ $rating->control_hours }}</li>@endforeach 
                @endif
              </td>
              <td align="center">
                <div class="form-check form-check-inline">
                  <input type="radio" class="form-check-input" name="verification_status[{{$i+1}}]" value="Ya"><label class="form-check-label mr-2">Ya</label>
                  <input type="radio" class="form-check-input" id="verification_status[{{$i+1}}]" name="verification_status[{{$i+1}}]" value="Tidak" checked><label class="form-check-label">Tidak</label>
                </div>
              </td>     
              <td align="center">
                <div class="form-check form-check-inline">
                  <input type="radio" class="form-check-input" name="verification_match[{{$i+1}}]" value="Ya"><label class="form-check-label mr-2">Ya</label>
                  <input type="radio" class="form-check-input" id="verification_match[{{$i+1}}]" name="verification_match[{{$i+1}}]" value="Tidak" checked><label class="form-check-label">Tidak</label>
                </div>
              </td>
              <td align="center">
                  <input type="text" name="remark[{{$i+1}}]" class="form-control">
              </td>
            </tr>
          @endif
        @endfor
         
        <tr>
          <td colspan="3"></td>
          <td colspan="2" width="5px" align="center" scope="col" style="padding-left: 1px; padding-right: 1px;">
            <button class="btn btn-primary fas fa-edit" id="verify"> Verified</button>
          </td>
        </tr>
      </form>
      </tbody>
    </table>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function () {
    finish();
        
    function finish(){
      $('#verify').click(function(){
        var radio = $('.radio'), formValid = true;
        console.log(radio.length);
        empty = [];
        for( var j=0; j<radio.length; j++ ) {
          if( isNoChecked(radio[j], "radio") ) {
            empty.push(j+1)
            formValid = false;
          }
        }
        if(formValid){
          var conf = confirm("Are you sure want to submit it???");
        
          if(conf==true){
            $('#verify').hide();
          }else{
            $('#verify').show();
          }
          return conf;
        }else{
          var conf = confirm(`Verification unfulfilled, item number ${empty} not verified yet`);
        
          if(conf==true || conf==false){
            return false;
          }
          return conf;
          
        }
          
        function isNoChecked(sel) {
         
          var check = sel.getElementsByTagName('input');
          for (var i=0; i<check.length; i++) {
            if (check[i].type == 'radio' && check[i].value == 'Tidak' && check[i].checked) {
              return true;
            } 
          }
          return false;
        }
      });
    }
  });
</script>
@endsection