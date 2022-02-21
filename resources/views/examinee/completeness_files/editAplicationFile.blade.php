@extends('examinee/main')

@section('title', 'Edit Application')
    
@section('section-header')
<h1>Edit Application</h1>    
@endsection

@section('section-title')
    Edit Application Form
@endsection

@section('contain')
<div class="card">
  <div card="card-body">
    <div class="table-responsive">
      <div class="card-body">
        <div class="form-group">
          <form method="post" action="/aplication_files/{{$aplication_file->id}}">
          @method('patch')
          @csrf

          <div class="form-group">
            <label for="license"><b>License</b></label>
            <select name="license_id" id="license" 
            class="form-control @error ('license_id') is-invalid @enderror">
              <option value=""></option>
              @foreach ($license as $license)
              <option value="{{ $license->id }}" {{ $aplication_file->license_id == $license->id ? 'selected' : '' }}>{{ $license->comment }}</option>
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
              <option value="{{ $logbook->id }}" {{ $aplication_file->logbook_id == $logbook->id ? 'selected' : '' }}>{{ $logbook->comment }}</option>
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
              <option value="{{ $activity->id }}" {{ $aplication_file->activity_id == $activity->id ? 'selected' : '' }}>{{ $activity->activity }}</option>
              @endforeach
            </select>
            @error('activity_id') <div class="invalid-feedback">{{ $message }}</div>@enderror      
          </div>

          <div class="form-group">
            <label for="session"><b>PERIODE</b></label>
            <select name="session_id" id="session" class="form-control @error ('session_id') is-invalid @enderror">
              <option value="{{ $session->id }}" {{ $aplication_file->session_id == $session->id ? 'selected' : '' }}>Tahun {{ $session->year }}
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
                <div class="form-check form-check-inline">
                  <input class="form-check-input  @error ('remark_ap_file_id') is-invalid @enderror" type="radio" name="remark_ap_file_id" id="{{$aplication_file->remark_ap_file->id}}" value="{{$aplication_file->remark_ap_file->id}}"
                  checked disabled>
                  <label class="form-check-label" for="1">
                    {{ $aplication_file->remark_ap_file->remark }} 
                  </label>
                </div>    
              </div>
            </div>
          </fieldset>
                    
          <div class="form-group row">
            <label for="ats_name" class="col-sm-2 col-form-label"><font size="3px">B. Nama ATS Unit</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('ats_name') is-invalid @enderror" 
              id="ats_name" name="ats_name" placeholder="ATS unit" value="{{ $aplication_file->ats_name }}">
              @error('ats_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="address" class="col-sm-2 col-form-label"><font size="3px">C. Alamat Kantor</font></label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('address') is-invalid @enderror" 
              id="address" name="address" placeholder="Alamat kantor" value="{{ $aplication_file->address }}">
              <span id="count" style="color:black"></span> karakter tersisa
              @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          <fieldset class="form-group">
            <div class="row">
              <label class="col-form-label col-sm-2 pt-0"><font size="3px">D. Jenis Rating yang dimohonkan</font></label>
              <div class="col-sm-10">
                {{-- @foreach ($form_rating as $fr)
                  <div class="form-check">
                  <input class="form-check-input @error ('rating_id') is-invalid @enderror" type="checkbox" 
                  name="rating_id[]" value="{{$fr->rating_id}}" 
                  @foreach ($aplication_file->form_rating as $file)
                  @if(in_array($file->rating_id, [$fr->rating_id])) checked disabled @endif   
                  @endforeach>

                  <label class="form-check-label">
                    ({{$fr->rating->rating}}) {{$fr->rating->full}}
                  </label>
                    
                    <div class="form-inline">
                      <input type="text" name="control_hour[]" class="form-control form-inline mb-2 @error ('control_hour') is-invalid @enderror"
                        @foreach ($aplication_file->form_rating as $f)
                          @if(in_array($f->rating_id, [$fr->rating_id]))
                          value="{{ $f->control_hours }}"
                          @endif
                        @endforeach
                      placeholder="Jumlah jam pemanduan">
                      @error('control_hour')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>   
                    
                  </div>
                  @error('rating_id') <div class="invalid-feedback">{{ $message }}</div>@enderror   
                @endforeach --}}
                @foreach ($aplication_rating as $ar)
                  <div class="form-check">
                    <input class="form-check-input @error ('rating_id') is-invalid @enderror" type="checkbox" 
                    name="rating_id[]" value="{{$ar->rating_id}}" 
                    @foreach ($aplication_file->form_rating as $file)
                    @if(in_array($file->rating_id, [$ar->rating_id])) checked @endif   
                    @endforeach>

                    <label class="form-check-label">
                      ({{$ar->rating->rating}}) {{$ar->rating->full}}
                    </label>

                    <div class="form-inline">
                      <input type="text" name="control_hour[{{$ar->rating_id}}]" class="form-control form-inline mb-2 @error ('control_hour') is-invalid @enderror"
                        @foreach ($aplication_file->form_rating as $f)
                          @if(in_array($f->rating_id, [$ar->rating_id]))
                          value="{{ $f->control_hours }}"
                          @endif
                        @endforeach
                      placeholder="Jumlah jam pemanduan">
                      @error('control_hour')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>  
                  </div>
                @endforeach
              </div>
            </div>
          </fieldset>

                   
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
                <input type="text" type="text" class="form-control form-inline mb-2 mr-sm-2" id="age" name="age" width="5px" placeholder="Umur sekarang" class="form-control form-inline mb-2 mr-sm-2" value="{{ $age }}" readonly>
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
                  {{ $biodata->english_confirm == 'ya' ? 'checked' : '' }}>
                  <label class="form-check-label" for="Ya">
                    Ya
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('english_confirm') is-invalid @enderror" type="radio" name="english_confirm" id="Tidak" value="tidak"
                  {{ $biodata->english_confirm == 'tidak' ? 'checked' : '' }}>
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
              id="height" name="height" placeholder="Tinggi" value="{{$biodata->height }}">
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
                  <input class="form-check-input  @error ('rating_confirm') is-invalid @enderror" type="radio" name="rating_confirm" id="rc_yes_rd" value="ya"
                  {{ $rating_confirm->confirm == "ya" ? 'checked':'' }}>
                  <label class="form-check-label" for="rc_yes_rd">
                    Ya
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('rating_confirm') is-invalid @enderror" type="radio" name="rating_confirm" id="rc_no_rd" value="tidak"
                  {{ $rating_confirm->confirm == "tidak" ? 'checked':'' }}>
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
                    {{ $remark_rating[0] == 'dicabut' ? 'checked' : '' }} checked>
                    <label class="form-check-label" for="dicabut">
                      Dicabut
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('rating_confirm2') is-invalid @enderror" type="radio" name="rating_confirm2" id="dibekukan" value="dibekukan"
                    {{ $remark_rating[0] == 'dibekukan' ? 'checked' : '' }}>
                    <label class="form-check-label" for="dibekukan">
                      Dibekukan
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('rating_confirm2') is-invalid @enderror" type="radio" name="rating_confirm2" id="lainnya" value="lainnya"
                    {{ $remark_rating[0] == 'lainnya' ? 'checked' : '' }}>
                    <label class="form-check-label" for="lainnya">
                      Lainnya
                    </label>
                    <input type="text" name="input_lainnya" id="input_lainnya" value="@if($rating_confirm->confirm=="ya") {{ $remark_rating[1] }} @endif">
                  </div>  
                </div>
              </div>
            </fieldset>

            <fieldset class="form-group">
              <div class="row">
                <label class="col-form-label col-sm-2 pt-0"><font size="3px">13c. Jenis Rating yang dimohonkan</font></label>
                <div class="col-sm-10">
                  @foreach ($rating2 as $r)
                  <div class="form-check">
                    <input class="form-check-input @error ('rating_id2') is-invalid @enderror" type="checkbox" 
                      name="rating_id2[]" value="{{$r->id}}" 
                      @foreach ($rating3 as $r2)
                        @if(in_array($r2, [$r->id])) checked @endif   
                      @endforeach
                    >
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
                id="location" name="location" value="{{ $rating_confirm->location }}">
              </div>
            </div>

            <div class="form-group row">
              <label for="freze_date" class="col-sm-2 col-form-label"><font size="3px">13e. Tanggal pencabutan/pembekuan</font></label>
              <div class="col-sm-10">
                <input type="date" name="freze_date" class="form-control" value="{{ $rating_confirm->date }}">
              </div>
            </div>
          </div>

          <fieldset class="form-group">
            <div class="row">
              <label class="col-form-label col-sm-2 pt-0"><font size="3px" color="black"><p align="justify">14a. Apakah anda pernah memiliki sertifikat kesehatan minimal kelas 3?</p></font></label>
              <div class="col-sm-10">
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('medex_confirm') is-invalid @enderror @error ('medex_date') is-invalid @enderror
                  @error ('medexExpired') is-invalid @enderror @error ('examiner') is-invalid @enderror" type="radio" name="medex_confirm" id="md_yes_rd" value="ya"
                  {{ $aplication_file->medex->confirm == "ya" ? 'checked':'' }}>
                  <label class="form-check-label" for="md_yes_rd">
                    Ya
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('medex_confirm') is-invalid @enderror  @error ('medex_date') is-invalid @enderror
                  @error ('medexExpired') is-invalid @enderror @error ('examiner') is-invalid @enderror" type="radio" name="medex_confirm" id="md_no_rd" value="tidak"
                  {{ $aplication_file->medex->confirm == "tidak" ? 'checked':'' }}>
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
                <input type="date" name="medex_date" class="form-control  @error ('medex_date') is-invalid @enderror" value="{{ $aplication_file->medex->released->format('Y-m-d') }}" id="medex_date">
                @error('medex_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="form-group row" id="medexInput">
              <label for="expiredMedex" class="col-sm-2 col-form-label"><font size="3px">Medex's Expired</font></label>
              <div class="col-sm-10">
                <input type="text" class="form-control  @error ('medexExpired') is-invalid @enderror" 
                id="expiredMedex" name="medexExpired" value="{{ $aplication_file->medex->expired->format('d-m-Y') }}" readonly>
                @error('medexExpired')<div class="invalid-feedback">{{ $message }}</div>@enderror  
              </div>
             
            </div>
         
            <div class="form-group row">
              <label for="examiner" class="col-sm-2 col-form-label"><font size="3px">14c. Nama Penguji</font></label>
              <div class="col-sm-10">
                <input type="text" class="form-control  @error ('examiner') is-invalid @enderror" 
                name="examiner" value="{{ $aplication_file->medex->examiner }}">
                @error('examiner')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>
          </div>
        
          <fieldset class="form-group">
            <div class="row">
              <label class="col-form-label col-sm-2 pt-0"><font size="3px" color="black"><p align="justify">15a. Apakah anda pernah memiliki sertifikat ICAO Language Proficiency?</p></font></label>
              <div class="col-sm-10">
                <div class="form-check form-check-inline">
                  <input class="form-check-input  @error ('ielp_confirm') is-invalid @enderror @error ('rater') is-invalid @enderror 
                  @error ('institution') is-invalid @enderror @error ('ielp_date') is-invalid @enderror 
                  @error ('ielpExpired') is-invalid @enderror @error ('levell') is-invalid @enderror" type="radio" name="ielp_confirm" id="ielp_yes_rd" value="ya"
                  {{ $aplication_file->ielp->confirm == "ya" ? 'checked':'' }}>
                  <label class="form-check-label" for="ielp_yes_rd">
                    Ya
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input @error ('ielp_confirm') is-invalid @enderror  @error ('rater') is-invalid @enderror 
                  @error ('institution') is-invalid @enderror @error ('ielp_date') is-invalid @enderror 
                  @error ('ielpExpired') is-invalid @enderror @error ('levell') is-invalid @enderror" type="radio" name="ielp_confirm" id="ielp_no_rd" value="tidak"
                  {{ $aplication_file->ielp->confirm == "tidak" ? 'checked':'' }}>
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
                id="rater" name="rater" value="{{ $aplication_file->ielp->rater }}">
                @error('rater')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="institution" class="col-sm-2 col-form-label"><font size="3px">15c. Lembaga Pelatihan</font></label>
              <div class="col-sm-10">
                <input type="text" class="form-control @error ('institution') is-invalid @enderror" 
                id="institution" name="institution" value="{{ $aplication_file->ielp->institution }}">
                @error('institution')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="ielp_date" class="col-sm-2 col-form-label"><font size="3px">15d. Tanggal dikeluarkan</font></label>
              <div class="col-sm-10">
                <input type="date" name="ielp_date" class="form-control @error ('ielp_date') is-invalid @enderror" value="{{ $aplication_file->ielp->released->format('Y-m-d') }}" id="ielp_date">
                @error('ielp_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="level" class="col-sm-2 col-form-label"><font size="3px">15e. Level</font></label>
              <div class="col-sm-10">
                <select name="levell" id="level" class="form-control @error ('levell') is-invalid @enderror">
                  <option value="" ></option>
                  <option value="4" {{ $aplication_file->ielp->level == 4 ? 'selected' : '' }}>Level 4</option>
                  <option value="5" {{ $aplication_file->ielp->level == 5 ? 'selected' : '' }}>Level 5</option>
                  <option value="6" {{ $aplication_file->ielp->level == 6 ? 'selected' : '' }}>Level 6</option>
                </select>
              </div>
            </div>

            <div class="form-group row" id="ielpInput">
              <label for="expiredielp" class="col-sm-2 col-form-label"><font size="3px">Ielp's Expired</font></label>
              <div class="col-sm-10">
                <input type="text" class="form-control @error ('ielpExpired') is-invalid @enderror" 
                id="expiredIelp" name="ielpExpired" value="{{ $aplication_file->ielp->expired->format('d-m-Y') }}" readonly>
                @error('ielpExpired')<div class="invalid-feedback">{{ $message }}</div>@enderror  
              </div>
            </div>
          </div>

          @if ($aplication_file->control->confirm=="ya")
          <fieldset class="form-group">
          <div class="row">
            <label class="col-form-label col-sm-2 pt-0"><font size="3px" color="black"><p align="justify">16a. Apakah anda telah melaksanakan pemanduan Lalu Lintas Penerbangan dibawah
              dibawah pengawasan OTI?</p></font><font size="3px" color="red">*Hanya untuk pengambilan rating</font></label>
            <div class="col-sm-10">
              <div class="form-check form-check-inline">
                <input class="form-check-input  @error ('control_confirm') is-invalid @enderror" type="radio" name="control_confirm" id="control_yes_rd" value="ya"
                {{ $aplication_file->control->confirm == "ya" ? 'checked':'' }}>
                <label class="form-check-label" for="control_yes_rd">
                  Ya
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input @error ('control_confirm') is-invalid @enderror" type="radio" name="control_confirm" id="control_no_rd" value="tidak"
                {{ $aplication_file->control->confirm == "tidak" ? 'checked':'' }}>
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
                  <input type="date" name="start" class="form-control" value="{{ $aplication_file->control->start->format('Y-m-d') }}" id="start">
                </div>
              </div>

              <div class="form-group row">
                <label for="finish" class="col-sm-2 col-form-label"><font size="3px">16c. Tanggal berakhir</font></label>
                <div class="col-sm-10">
                  <input type="date" name="finish" class="form-control" value="{{ $aplication_file->control->finish->format('Y-m-d') }}" id="finish">
                </div>
              </div>

              <div class="form-group row">
                <label for="control" class="col-sm-2 col-form-label"><font size="3px">16d. Jumlah jam pemanduan?</font></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" 
                  id="control" name="control" value="{{ $aplication_file->control->control_hours }}">
                </div>
              </div>

              <div class="form-group row">
                <label for="ojti_id" class="col-sm-2 col-form-label"><font size="3px">16e. Nomor Lisensi OJTI</font></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" 
                  id="ojti_id" name="ojti_id" value="{{ $aplication_file->control->ojti_id }}">
                </div>
              </div>
                        
              <div class="form-group row">
                <label for="ojti" class="col-sm-2 col-form-label"><font size="3px">16f. Nama OJTI</font></label>
                <div id="ojti_name">
                  <div class="col-sm-10">
                    <input type="text" class="form-control mb-2 mr-sm-5" value="{{ $aplication_file->control->ojti->name }}" readonly> 
                  </div>
                </div>
              </div>
            </div>
          @endif

            <fieldset class="form-group">
              <div class="row">
                <label class="col-form-label col-sm-2 pt-0"><font size="3px" color="black"><p align="justify">17. Apakah anda terlibat pelanggaran yang disebabkan oleh penggunaan obat-obatan terlarang, marijuana dan obat anti depresi atau obat stimulant atau pengoperasian kendaraan bermotor dengan pengaruh alkhohol?</p></font></label>
                <div class="col-sm-10">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input  @error ('drugs_confirm') is-invalid @enderror" type="radio" name="drugs_confirm" id="drugs_yes_rd" value="ya"
                    {{ $aplication_file->drugs == "ya" ? 'checked':'' }}>
                    <label class="form-check-label" for="drugs_yes_rd">
                      Ya
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('drugs_confirm') is-invalid @enderror" type="radio" name="drugs_confirm" id="drugs_no_rd" value="tidak"
                    {{ $aplication_file->drugs == "tidak" ? 'checked':'' }}>
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
                      @foreach ($education_owner as $education)
                      @if(in_array($education->formal_education_id, [$fe->id])) checked disabled @endif   
                      @endforeach
                      disabled>
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
                      placeholder="Tahun" readonly>
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
                      @foreach ($sertificate_owner as $se)
                      @if(in_array($se->sertificate_id, [$sertificate->id])) checked disabled @endif   
                      @endforeach
                      disabled> 
                      
                    <label class="form-check-label">
                      {{ $sertificate->sertificate }}
                    </label>
                    <div class="form-inline">
                      <input type="text" name="sertificate_institution[{{ $sertificate->id }}]" class="form-control form-inline mb-2 mr-sm-2 @error ('sertificate_institution') is-invalid @enderror" 
                        @foreach ($sertificate_owner as $so)
                          @if(in_array($so->sertificate_id, [$sertificate->id]))
                          value="{{ $so->institution }}"
                          @endif
                        @endforeach 
                      placeholder="Lembaga Pelatihan" readonly>

                      <input type="date" name="sertificate_released[{{ $sertificate->id }}]" class="form-control form-inline mb-2 mr-sm-2 @error ('sertificate_released') is-invalid @enderror" 
                        @foreach ($sertificate_owner as $so)
                          @if(in_array($so->sertificate_id, [$sertificate->id]))
                          value="{{ $so->released->format('Y-m-d') }}"
                          @endif
                        @endforeach readonly>
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
                    {{ $aplication_file->failed == "ya" ? 'checked':'' }}>
                    <label class="form-check-label" for="failed_yes_rd">
                      Ya
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error ('failed_confirm') is-invalid @enderror" type="radio" name="failed_confirm" id="failed_no_rd" value="tidak"
                    {{ $aplication_file->failed == "tidak" ? 'checked':'' }}>
                    <label class="form-check-label" for="failed_no_rd">
                      Tidak
                    </label>
                  </div>  
                </div>
              </div>
            </fieldset>
            <button type="submit" class="btn btn-success fas fa-edit"> Edit</button>
          
          </form>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/length.js') }}"></script>  
@endsection