<div class="form-group row">
  <label for="quantity" class="col-sm-2 col-form-label"><font size="3px">Quantity</font></label>
  <div class="col-sm-10">
    <input type="text" class="form-control @error('quantity') is-invalid @enderror" 
    id="quantity" name="quantity" placeholder="Quantity" value="{{ $quantity }}" readonly>
    @error('quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>
