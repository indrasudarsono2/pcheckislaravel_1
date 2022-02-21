@extends('examinee/main')

@section('title', 'Add Application')
    
@section('section-header')
<h1>Add Application</h1>    
@endsection

@section('section-title')
    Add Application Form
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <form method="post" action="/af">
          @csrf
          
          <div class="form-group">
            <label for="license"><b>License</b></label>
            <select name="license_id" id="license" 
            class="form-control @error ('license_id') is-invalid @enderror">
              <option value=""></option>
              @foreach ($license as $license)
              <option value="{{ $license->id }}" {{ (old('license_id') == $license->id) ? 'selected' : '' }}>{{ $license->comment }}</option>
              @endforeach
            </select>
            @error('license_id') <div class="invalid-feedback">{{ $message }}</div>@enderror      
          </div>

          <div class="form-group">
            <label for="logbook"><b>Log Book</b></label>
            <select name="logbook_id" id="logbook" 
            class="form-control @error ('logbook_id') is-invalid @enderror">
              <option value=""></option>
              @foreach ($logbook as $logbook)
              <option value="{{ $logbook->id }}" {{ (old('logbook_id') == $logbook->id) ? 'selected' : '' }}>{{ $logbook->comment }}</option>
              @endforeach
            </select>
            @error('logbook_id') <div class="invalid-feedback">{{ $message }}</div>@enderror      
          </div>

          <div class="form-group">
            <label for="activity"><b>KEGIATAN YANG AKAN DILAKUKAN</b></label>
            <select name="activity_id" id="activity" 
            class="form-control @error ('activity_id') is-invalid @enderror">
              <option value=""></option>
              @foreach ($activity as $activity)
              <option value="{{ $activity->id }}" {{ (old('activity_id') == $activity->id) ? 'selected' : '' }}>{{ $activity->activity }}</option>
              @endforeach
            </select>
            @error('activity_id') <div class="invalid-feedback">{{ $message }}</div>@enderror      
          </div>

          <div class="form-group">
            <label for="session"><b>PERIODE</b></label>
            <select name="session_id" id="session" class="form-control @error ('session_id') is-invalid @enderror">
              <option value="{{ $session->id }}" {{ (old('session_id') == $session->id) ? 'selected' : '' }}>Tahun {{ $session->year }}
              periode {{$session->period}}</option>
            </select>
            @error('session_id') <div class="invalid-feedback">{{ $message }}</div>@enderror      
          </div>

          <font size="4x"><b> I. JENIS PERMOHONAN RATING</b></font>
          <br><br>
          
          <fieldset class="form-group">
            <div class="row">
              <label class="col-form-label col-sm-2 pt-0"><font size="3px" color="black">A. Jenis Permohonan</font></label>
              <div class="col-sm-10">
                @foreach ($remark_ap_file as $remark_ap_file)
                <div class="form-check form-check-inline">
                  <input class="form-check-input  @error ('remark_ap_file_id') is-invalid @enderror" type="radio" name="remark_ap_file_id" id="{{$remark_ap_file->id}}" value="{{$remark_ap_file->id}}"
                  {{ (old('remark_ap_file_id') == $remark_ap_file->id) ? 'checked' : '' }}>
                  <label class="form-check-label" for="{{$remark_ap_file->id}}">
                    {{$remark_ap_file->remark}}
                  </label>
                </div>    
                @endforeach
              </div>
            </div>
          </fieldset>
                    
          <div class="form-group row">
            <label for="ats_name" class="col-sm-2 col-form-label"><font size="3px">B. Nama ATS Unit</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('ats_name') is-invalid @enderror" 
              id="ats_name" name="ats_name" placeholder="ATS unit" value="{{ old('ats_name') }}">
              @error('ats_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="address" class="col-sm-2 col-form-label"><font size="3px">C. Alamat Kantor</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('address') is-invalid @enderror" 
              id="address" name="address" placeholder="Alamat kantor" value="{{ old('address') }}">
              <span id="count" style="color:black"></span> karakter tersisa
              @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          <fieldset class="form-group">
            <div class="row">
              <label class="col-form-label col-sm-2 pt-0"><font size="3px">D. Jenis Rating yang dimohonkan</font></label>
              <div class="col-sm-10">
                @foreach ($aplication_rating as $rating)
                <div class="form-check">
                  <input class="form-check-input @error ('rating_id') is-invalid @enderror" type="checkbox" 
                    name="rating_id[]" value="{{$rating->rating_id}}"  @if(is_array(old('rating_id')) && in_array($rating->rating_id, old('rating_id'))) checked @endif>
                  <label class="form-check-label">
                    ({{$rating->rating->rating}}) {{$rating->rating->full}}
                  </label>
                  <div class="form-inline">
                    <input type="text" name="control_hour[{{$rating->rating_id}}]" class="form-control form-inline mb-2 
                    @if(is_array(old('rating_id')) && in_array($rating->rating_id, old('rating_id'))) 
                    @error ('control_hour') is-invalid @enderror @endif" 
                    value="{{ old('control_hour.'.$rating->rating_id) }}" placeholder="Jumlah jam pemanduan" >
                    @error('control_hour.'.$rating->rating_id) <div class="invalid-feedback mb-2">{{ $message }}</div>@enderror
                  </div>
                </div>
                @error('rating_id') <div class="invalid-feedback">{{ $message }}</div>@enderror   
                @endforeach
              </div>
            </div>
          </fieldset>
          <br><br>
          
          <font size="4px"><b> II. INFORMASI PEMOHON</b></font>
          <br><br>
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label"><font size="3px">1. Nama</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('name') is-invalid @enderror" 
              id="name" name="name" placeholder="Nama" value="{{ Auth::user()->name }}">
              @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="user_id" class="col-sm-2 col-form-label"><font size="3px">2. Nomor Lisensi</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('user_id') is-invalid @enderror" 
              id="user_id" name="user_id" placeholder="Nomor Lisensi" value="{{ Auth::id() }}" readonly>
              @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror  
            </div>
          </div>
          
          <div class="form-group row">
            <label for="date_of_birth" class="col-sm-2 col-form-label"><font size="3px">3. Tanggal Lahir</font></label>
            <div class="col-sm-10">
              <div class="form-inline">
                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control form-inline mb-2 mr-sm-2 @error ('date_of_birth') is-invalid @enderror"  value="{{ $biodata->date_of_birth->format('Y-m-d') }}">
                <input type="text" type="text" class="form-control form-inline mb-2 mr-sm-2" name="age" id="age" width="5px" placeholder="Umur sekarang" class="form-control form-inline mb-2 mr-sm-2" value="{{ $age }} tahun" readonly>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="place_of_birth" class="col-sm-2 col-form-label"><font size="3px">4. Tempat Lahir</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" 
              id="place_of_birth" name="place_of_birth" placeholder="Tempat lahir" value="{{ $biodata->place_of_birth }}">
              @error('place_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="address_user" class="col-sm-2 col-form-label"><font size="3px">5. Alamat Tinggal</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('address_user') is-invalid @enderror" 
              id="address_user" name="address_user" placeholder="Alamat tempat tinggal sekarang" value="{{ $biodata->address_user }}">
              <span id="count_user" style="color:black"></span> karakter tersisa
              @error('address_user')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="nationality" class="col-sm-2 col-form-label"><font size="3px">6. Kebangsaan</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('nationality') is-invalid @enderror" 
              id="nationality" name="nationality" placeholder="Kebangsaan" value="{{ $biodata->nationality }}">
              @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          <fieldset class="form-group">
            <div class="row">
              <label class="col-form-label col-sm-2 pt-0"><font size="3px" color="black">7. Bisa berbahasa Inggris?</font></label>
              <div class="col-sm-10">
                <div class="form-check form-check-inline">
                  <input class="form-check-input  @error ('english_confirm') is-invalid @enderror" type="radio" name="english_confirm" id="Ya" value="ya"
                  {{ (old('english_confirm') == 'ya') ? 'checked' : '' }}>
                  <label class="form-check-label" for="Ya">
                    Ya
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('english_confirm') is-invalid @enderror" type="radio" name="english_confirm" id="Tidak" value="tidak"
                  {{ (old('english_confirm') == 'tidak') ? 'checked' : '' }}>
                  <label class="form-check-label" for="Tidak">
                    Tidak
                  </label>
                </div>
              </div>
            </div>
          </fieldset>

          <div class="form-group row">
            <label for="height" class="col-sm-2 col-form-label"><font size="3px">8. Tinggi</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('height') is-invalid @enderror" 
              id="height" name="height" placeholder="Tinggi" value="{{ $biodata->height }}">
              @error('height')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="weight" class="col-sm-2 col-form-label"><font size="3px">9. Berat</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('weight') is-invalid @enderror" 
              id="weight" name="weight" placeholder="Berat" value="{{ $biodata->weight }}">
              @error('weight')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="hair" class="col-sm-2 col-form-label"><font size="3px">10. Rambut</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('hair') is-invalid @enderror" 
              id="hair" name="hair" placeholder="Rambut" value="{{ $biodata->hair }}">
              @error('hair')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
          
          <div class="form-group row">
            <label for="eyes" class="col-sm-2 col-form-label"><font size="3px">11. Mata</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('eyes') is-invalid @enderror" 
              id="eyes" name="eyes" placeholder="Mata" value="{{ $biodata->eyes }}">
              @error('eyes')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          <fieldset class="form-group">
            <div class="row">
              <label class="col-form-label col-sm-2 pt-0"><font size="3px" color="black">12. Jenis Kelamin</font></label>
              <div class="col-sm-10">
                @foreach ($gender as $gender)
                <div class="form-check form-check-inline">
                  <input class="form-check-input  @error ('gender_id') is-invalid @enderror" type="radio" name="gender_id" id="1" value="{{$gender->id}}"
                  {{ $biodata->gender_id == $gender->id ? 'checked' : '' }}>
                  <label class="form-check-label" for="1">
                    {{$gender->gender}}
                  </label>
                </div>    
                @endforeach
              </div>
            </div>
          </fieldset>

          <fieldset class="form-group">
            <div class="row">
              <label class="col-form-label col-sm-2 pt-0"><font size="3px" color="black"><p align="justify"> 13a. Apakah anda pernah memiliki Rating sebelumnya?</p></font></label>
              <div class="col-sm-10">
                <div class="form-check form-check-inline">
                  <input class="form-check-input  @error ('rating_confirm') is-invalid @enderror
                  @error ('rating_confirm2') is-invalid @enderror @error ('rating_id2') is-invalid @enderror
                  @error ('input_lainnya') is-invalid @enderror @error ('location') is-invalid @enderror" type="radio" name="rating_confirm" id="rc_yes_rd" value="ya"
                  {{ (old('rating_confirm') == "ya")? 'checked':'' }}>
                  <label class="form-check-label" for="rc_yes_rd">
                    Ya
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('rating_confirm') is-invalid @enderror" type="radio" name="rating_confirm" id="rc_no_rd" value="tidak"
                  {{ (old('rating_confirm') == "tidak")? 'checked':'' }}>
                  <label class="form-check-label" for="rc_no_rd">
                    Tidak
                  </label>
                </div>
              </div>
            </div>
          </fieldset>

          <div id="rating_confirm">
            <fieldset class="form-group">
              <div class="row">
                <label class="col-form-label col-sm-2 pt-0"><font size="3px" color="black">13b. Apakah Rating anda dicabut atau dibekukan?</font></label>
                <div class="col-sm-10">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('rating_confirm2') is-invalid @enderror" type="radio" name="rating_confirm2" id="dicabut" value="dicabut"
                    {{ (old('rating_confirm2') == 'dicabut') ? 'checked' : '' }}>
                    <label class="form-check-label" for="dicabut">
                      Dicabut
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('rating_confirm2') is-invalid @enderror" type="radio" name="rating_confirm2" id="dibekukan" value="dibekukan"
                    {{ (old('rating_confirm2') == 'dibekukan') ? 'checked' : '' }}>
                    <label class="form-check-label" for="dibekukan">
                      Dibekukan
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('rating_confirm2') is-invalid @enderror @error ('input_lainnya') is-invalid @enderror" type="radio" name="rating_confirm2" id="lainnya" value="lainnya"
                    {{ (old('rating_confirm2') == 'lainnya') ? 'checked' : '' }}>
                    <label class="form-check-label" for="lainnya">
                      Lainnya
                    </label>
                    <input class="@error ('input_lainnya') is-invalid @enderror" type="text" name="input_lainnya" id="input_lainnya" value="{{ old('input_lainnya') }}">
                    @error('input_lainnya')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>  
                </div>
              </div>
            </fieldset>

            <fieldset class="form-group">
              <div class="row">
                <label class="col-form-label col-sm-2 pt-0"><font size="3px">13c. Jenis Rating</font></label>
                <div class="col-sm-10">
                  @foreach ($rating2 as $r)
                  <div class="form-check">
                    <input class="form-check-input  @error ('rating_id2') is-invalid @enderror" type="checkbox" 
                      name="rating_id2[]" value="{{$r->id}}" @if(in_array($r->id, old('rating_id2', []))) checked @endif>
                    <label class="form-check-label">
                      {{$r->rating}}
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
            </fieldset>

            <div class="form-group row">
              <label for="location" class="col-sm-2 col-form-label"><font size="3px">13d. Lokasi Rating</font></label>
              <div class="col-sm-10">
                <input type="text" class="form-control @error ('location') is-invalid @enderror" 
                id="location" name="location" value="{{ old('location') }}">
                @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="freze_date" class="col-sm-2 col-form-label"><font size="3px">13e. Tanggal pencabutan/pembekuan</font></label>
              <div class="col-sm-10">
                <input type="date" name="freze_date" class="form-control" value="{{ old('freze_date') }}">
              </div>
            </div>
          </div>

          <fieldset class="form-group">
            <div class="row">
              <label class="col-form-label col-sm-2 pt-0"><font size="3px" color="black"><p align="justify">14a. Apakah anda pernah memiliki sertifikat kesehatan minimal kelas 3?</p></font></label>
              <div class="col-sm-10">
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('medex_confirm') is-invalid @enderror  @error ('medex_date') is-invalid @enderror 
                  @error ('medexExpired') is-invalid @enderror @error ('examiner') is-invalid @enderror" type="radio" name="medex_confirm" id="md_yes_rd" value="ya"
                  {{ $medex->confirm == "ya"? 'checked':'' }}>
                  <label class="form-check-label" for="md_yes_rd">
                    Ya
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('medex_confirm') is-invalid @enderror  @error ('medex_date') is-invalid @enderror 
                  @error ('medexExpired') is-invalid @enderror @error ('examiner') is-invalid @enderror" type="radio" name="medex_confirm" id="md_no_rd" value="tidak"
                  {{ $medex->confirm == "tidak"? 'checked':'' }}>
                  <label class="form-check-label" for="md_no_rd">
                    Tidak
                  </label>
                </div>
              </div>
            </div>
          </fieldset>

          <div id="medex_confirm">
            <div class="form-group row">
              <label for="medex_date" class="col-sm-2 col-form-label"><font size="3px">14b. Tanggal dikeluarkan</font></label>
              <div class="col-sm-10">
                <input type="date" name="medex_date" class="form-control  @error ('medex_date') is-invalid @enderror" value="{{ $medex->released->format('Y-m-d') }}" id="medex_date">
                @error('medex_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="form-group row" id="medexInput">
              <label for="expiredMedex" class="col-sm-2 col-form-label"><font size="3px">Medex's Expired</font></label>
              <div class="col-sm-10">
                <input type="text" class="form-control  @error ('medexExpired') is-invalid @enderror" 
                id="expiredMedex" name="medexExpired" value="{{ $medex->expired->format('d-m-Y') }}" readonly>
                @error('medexExpired')<div class="invalid-feedback">{{ $message }}</div>@enderror  
              </div>
             
            </div>
         
            <div class="form-group row">
              <label for="examiner" class="col-sm-2 col-form-label"><font size="3px">14c. Nama Penguji</font></label>
              <div class="col-sm-10">
                <input type="text" class="form-control  @error ('examiner') is-invalid @enderror" 
                name="examiner" value="{{ $medex->examiner }}">
                @error('examiner')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>
          </div>
        
          <fieldset class="form-group">
            <div class="row">
              <label class="col-form-label col-sm-2 pt-0"><font size="3px" color="black"><p align="justify">15a. Apakah anda pernah memiliki sertifikat ICAO Language Proficiency?</p></font></label>
              <div class="col-sm-10">
                <div class="form-check form-check-inline">
                  <input class="form-check-input  @error ('ielp_confirm') is-invalid @enderror @error ('ielpExpired') is-invalid @enderror
                  @error ('rater') is-invalid @enderror @error ('institution') is-invalid @enderror @error ('ielp_date') is-invalid @enderror
                  @error ('levell') is-invalid @enderror" type="radio" name="ielp_confirm" id="ielp_yes_rd" value="ya"
                  {{ $ielp->confirm == "ya"? 'checked':'' }}>
                  <label class="form-check-label" for="ielp_yes_rd">
                    Ya
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('ielp_confirm') is-invalid @enderror  @error ('ielpExpired') is-invalid @enderror
                  @error ('rater') is-invalid @enderror @error ('institution') is-invalid @enderror @error ('ielp_date') is-invalid @enderror
                  @error ('levell') is-invalid @enderror" type="radio" name="ielp_confirm" id="ielp_no_rd" value="tidak"
                  {{ $ielp->confirm == "tidak"? 'checked':'' }}>
                  <label class="form-check-label" for="ielp_no_rd">
                    Tidak
                  </label>
                </div> 
              </div>
            </div>
          </fieldset>

          <div id="ielp_confirm">
            <div class="form-group row">
              <label for="rater" class="col-sm-2 col-form-label"><font size="3px">15b. Nama Rater</font></label>
              <div class="col-sm-10">
                <input type="text" class="form-control @error ('rater') is-invalid @enderror" 
                id="rater" name="rater" value="{{ $ielp->rater }}">
                @error('rater')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="institution" class="col-sm-2 col-form-label"><font size="3px">15c. Lembaga Pelatihan</font></label>
              <div class="col-sm-10">
                <input type="text" class="form-control @error ('institution') is-invalid @enderror" 
                id="institution" name="institution" value="{{ $ielp->institution }}">
                @error('institution')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="ielp_date" class="col-sm-2 col-form-label"><font size="3px">15d. Tanggal dikeluarkan</font></label>
              <div class="col-sm-10">
                <input type="date" name="ielp_date" class="form-control @error ('ielp_date') is-invalid @enderror" value="{{ $ielp->released->format('Y-m-d') }}" id="ielp_date">
                @error('ielp_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="level" class="col-sm-2 col-form-label"><font size="3px">15e. Level</font></label>
              <div class="col-sm-10">
                <select name="levell" id="level" class="form-control @error ('levell') is-invalid @enderror">
                  <option value="" ></option>
                  <option value="4" {{ $ielp->level == 4 ? 'selected' : '' }}>Level 4</option>
                  <option value="5" {{ $ielp->level == 5 ? 'selected' : '' }}>Level 5</option>
                  <option value="6" {{ $ielp->level == 6 ? 'selected' : '' }}>Level 6</option>
                </select>
              </div>
              @error('levell')<div class="invalid-feedback">{{ $message }}</div>@enderror 
            </div>

            <div class="form-group row" id="ielpInput">
              <label for="expiredielp" class="col-sm-2 col-form-label"><font size="3px">Ielp's Expired</font></label>
              <div class="col-sm-10">
                <input type="text" class="form-control @error ('ielpExpired') is-invalid @enderror" 
                id="expiredIelp" name="ielpExpired" value="{{ $ielp->expired->format('d-m-Y') }}" readonly>
                @error('ielpExpired')<div class="invalid-feedback">{{ $message }}</div>@enderror  
              </div>
            </div>
          </div>

          <fieldset class="form-group">
          <div class="row">
            <label class="col-form-label col-sm-2 pt-0"><font size="3px" color="black"><p align="justify">16a. Apakah anda telah melaksanakan pemanduan Lalu Lintas Penerbangan dibawah
              dibawah pengawasan OTI?</p></font><font size="3px" color="red">*Pilih "Ya" jika untuk pengambilan rating</font></label>
            <div class="col-sm-10">
              <div class="form-check form-check-inline">
                <input class="form-check-input @error ('control_confirm') is-invalid @enderror @error ('start') is-invalid @enderror"
                @error ('finish') is-invalid @enderror @error ('control') is-invalid @enderror @error ('ojti_id') is-invalid @enderror
                type="radio" name="control_confirm" id="control_yes_rd" value="ya"
                {{ (old('control_confirm') == "ya")? 'checked':'' }}>
                <label class="form-check-label" for="control_yes_rd">
                  Ya
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input @error ('control_confirm') is-invalid @enderror" type="radio" name="control_confirm" id="control_no_rd" value="tidak"
                {{ (old('control_confirm') == "tidak")? 'checked':'' }} checked>
                <label class="form-check-label" for="control_no_rd">
                  Tidak
                </label>
              </div>  
            </div>
          </div>
        </fieldset>

        <div id="control_confirm">
          <div class="form-group row">
            <label for="start" class="col-sm-2 col-form-label"><font size="3px">16b. Tanggal mulai</font></label>
            <div class="col-sm-10">
              <input type="date" name="start" class="form-control @error ('start') is-invalid @enderror" value="{{ old('start') }}" id="start">
              @error('start')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="finish" class="col-sm-2 col-form-label"><font size="3px">16c. Tanggal berakhir</font></label>
            <div class="col-sm-10">
              <input type="date" name="finish" class="form-control @error ('finish') is-invalid @enderror" value="{{ old('finish') }}" id="finish">
              @error('finish')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="control" class="col-sm-2 col-form-label"><font size="3px">16d. Jumlah jam pemanduan?</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error ('control') is-invalid @enderror" id="control" name="control" value="{{ old('control') }}">
              @error('control')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="ojti_id" class="col-sm-2 col-form-label"><font size="3px">16e. Nomor Lisensi OJTI</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error ('ojti_id') is-invalid @enderror" id="ojti_id" name="ojti_id" value="{{ old('ojti_id') }}">
              @error('ojti_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
                    
          <div class="form-group row">
            <label for="ojti" class="col-sm-2 col-form-label"><font size="3px">16f. Nama OJTI</font></label>
            <div id="ojti_name">
              <div class="col-sm-10">
                <input type="text" class="form-control mb-2 mr-sm-2" 
                id="ojti" name="ojti" value="{{ old('ojti') }}" readonly>
              </div>
            </div>
          </div>
        </div>

        <fieldset class="form-group">
          <div class="row">
            <label class="col-form-label col-sm-2 pt-0"><font size="3px" color="black"><p align="justify">17. Apakah anda terlibat pelanggaran yang disebabkan oleh penggunaan obat-obatan terlarang, marijuana dan obat anti depresi atau obat stimulant atau pengoperasian kendaraan bermotor dengan pengaruh alkhohol?</p></font></label>
            <div class="col-sm-10">
              <div class="form-check form-check-inline">
                <input class="form-check-input  @error ('drugs_confirm') is-invalid @enderror" type="radio" name="drugs_confirm" id="drugs_yes_rd" value="ya"
                {{ (old('drugs_confirm') == "tidak")? 'checked':'' }}>
                <label class="form-check-label" for="drugs_yes_rd">
                  Ya
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input @error ('drugs_confirm') is-invalid @enderror" type="radio" name="drugs_confirm" id="drugs_no_rd" value="tidak"
                {{ (old('drugs_confirm') == "tidak")? 'checked':'' }}>
                <label class="form-check-label" for="drugs_no_rd">
                  Tidak
                </label>
              </div>  
            </div>
          </div>
        </fieldset>

        <font size="4px"><b> III. LATAR BELAKANG PENDIDIKAN</b></font>
        <br><br>

        <fieldset class="form-group">
          <div class="row">
            <label class="col-form-label col-sm-2 pt-0"><font size="3px">1. Jenis Pendidikan Formal</font></label>
            <div class="col-sm-10">
              @foreach ($formal_education as $fe)
              <div class="form-check">
                <input class="form-check-input @error ('formal_education_id') is-invalid @enderror" type="checkbox" 
                  name="formal_education_id[]" value="{{ $fe->id }}" 
                  @foreach ($education_owner as $eo)
                  @if(in_array($eo->formal_education_id, [$fe->id])) checked @endif   
                  @endforeach
                >
                <label class="form-check-label">
                  {{$fe->education}}
                </label>
                <div class="form-inline">
                  <input type="text" name="year[{{$fe->id}}]" class="form-control form-inline mb-2 @error ('year') is-invalid @enderror" 
                  @foreach ($education_owner as $eo)
                    @if(in_array($eo->formal_education_id, [$fe->id]))
                    value="{{ $eo->year }}"
                    @endif
                  @endforeach
                  placeholder="Tahun"
                  >
                </div>
              </div>
              @error('formal_education_id') <div class="invalid-feedback">{{ $message }}</div>@enderror   
              @endforeach
            </div>
          </div>
        </fieldset>

        <fieldset class="form-group">
          <div class="row">
            <label class="col-form-label col-sm-2 pt-0"><font size="3px" color="black">2. Jenis Sertifikat Kompetensi?</font></label>
            <div class="col-sm-10">
              @foreach ($sertificate as $sertificate)
              <div class="form-check">
                <input class="form-check-input @error ('sertificate_id') is-invalid @enderror" type="checkbox" 
                  name="sertificate_id[]" value="{{$sertificate->id}}"
                  @foreach ($sertificate_owner1 as $so1)
                  @if(in_array($so1->sertificate_id, [$sertificate->id])) checked @endif   
                  @endforeach
                >
                <label class="form-check-label">
                  {{ $sertificate->sertificate }}
                </label>
                <div class="form-inline">
                  <input type="text" name="sertificate_institution[{{ $sertificate->id }}]" class="form-control form-inline mb-2 mr-sm-2 @error ('sertificate_institution') is-invalid @enderror" 
                  @foreach ($sertificate_owner1 as $so1)
                    @if(in_array($so1->sertificate_id, [$sertificate->id]))
                    value="{{ $so1->institution }}"
                    @endif
                  @endforeach
                  placeholder="Lembaga Pelatihan">
                  <input type="date" name="sertificate_released[{{ $sertificate->id }}]" class="form-control form-inline mb-2 mr-sm-2 @error ('sertificate_released') is-invalid @enderror" 
                  @foreach ($sertificate_owner1 as $so1)
                    @if(in_array($so1->sertificate_id, [$sertificate->id]))
                    value="{{ $so1->released->format('Y-m-d') }}"
                    @endif
                  @endforeach
                  >
                </div>
              </div>
              @error('sertificate') <div class="invalid-feedback">{{ $message }}</div>@enderror   
              @endforeach
            </div>
          </div>
        </fieldset>

        <fieldset class="form-group">
          <div class="row">
            <label class="col-form-label col-sm-2 pt-0"><font size="4px"><b><p align="justify"> IV. APAKAH ANDA PERNAH GAGAL UJIAN SEBELUMNYA, DALAM KURUN WAKTU 30 HARI?</p></b></font></label>
            <div class="col-sm-10">
              <div class="form-check form-check-inline">
                <input class="form-check-input  @error ('failed_confirm') is-invalid @enderror" type="radio" name="failed_confirm" id="failed_yes_rd" value="ya"
                {{ (old('failed_confirm') == "ya")? 'checked':'' }}>
                <label class="form-check-label" for="failed_yes_rd">
                  Ya
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input @error ('failed_confirm') is-invalid @enderror" type="radio" name="failed_confirm" id="failed_no_rd" value="tidak"
                {{ (old('failed_confirm') == "tidak")? 'checked':'' }}>
                <label class="form-check-label" for="failed_no_rd">
                  Tidak
                </label>
              </div>  
            </div>
          </div>
        </fieldset>

          
        <button type="submit" class="btn btn-primary fas fa-plus-square" id="create"> Create</button>
      
        </form>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/length.js') }}"></script>

@endsection