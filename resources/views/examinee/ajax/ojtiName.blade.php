<div class="col-sm-10">
  @foreach ($ojti as $ojti)
  <input type="text" class="form-control mb-2 mr-sm-5" value="{{ $ojti->name }}" readonly>  
  @endforeach
</div>