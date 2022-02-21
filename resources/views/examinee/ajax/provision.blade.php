@if ($aplication_file==null)
  <div class="card-wrap">
    <div class="card-header">
      <h4 style="color:white;font-size:18px;">Debriefing</h4>
    </div>
    <div class="card-body" id="provison">
      <font color="green">SUCCESS</font>
    </div>
  </div>
@else
  <div class="card-wrap">
    <div class="card-header">
      <h4 style="color:white;font-size:18px;">Debriefing {{ $aplication_file->number }}</h4>
    </div>
    <div class="card-body" id="provison">
      <div class="row">
        <div class="col-lg-12">
          <div class="input-group mb-3">
            <input type="text" class="form-control is-invalid" placeholder="Token" name="token" id="provision_input">
            <button href="#" class="btn btn-info fas fa-cogs" type="button" id="btn_provision"></button>
            <div class="invalid-feedback">Invalid token !!!</div>
          </div>
        </div>
      </div>
    </div>
  </div>  
@endif
<script src="{{ asset('stisla/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/provision.js') }}"></script>
