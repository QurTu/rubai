@extends('front-end.layout')



@section('content')
<div class="container">
			<h1>Shipping info</h1>
          
<form class="needs-validation"  action="{{route('shipping.add')}}" method="post" novalidate>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom01">First name</label>
      <input type="text" name='name' class="form-control" id="validationCustom01" placeholder="First name" value=""
        required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Last name</label>
      <input type="text" name='lastName' class="form-control" id="validationCustom02" placeholder="Last name" value=""
        required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    
  </div>
  <div class="form-row">
  <div class="col-md-6 mb-3">
      <label for="validationCustom02">phone number</label>
      <input type="text" name='phone' class="form-control" id="validationCustom06" placeholder="Last name" value=""
        required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    

  <div class="col-md-6 mb-3">
      <label for="validationCustom02">email</label>
      <input type="text" name='email' class="form-control" id="validationCustom06" placeholder="Last name" value=""
        required>
      <div class="valid-feedback">
        Looks good!
      </div>
  

  </div>


  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom03">Adresas</label>
      <input type="text" name='address' class="form-control" id="validationCustom03" placeholder="City" required>
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom04">miestas</label>
      <input type="text"name='city' class="form-control" id="validationCustom04" placeholder="State" required>
      <div class="invalid-feedback">
        Please provide a valid state.
      </div>

    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom05">Zip</label>
      <input type="text" name='zip' class="form-control" id="validationCustom05" placeholder="Zip" required>
      <div class="invalid-feedback">
        Please provide a valid zip.
      </div>
    </div>
  </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>
  

  @csrf
  <button class="btn btn-primary btn-sm" type="submit">Submit form</button>
</form>
</div>

@endsection


@section('scripts')
<script>  
(function() {
'use strict';
window.addEventListener('load', function() {
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {
form.addEventListener('submit', function(event) {
if (form.checkValidity() === false) {
event.preventDefault();
event.stopPropagation();
}
form.classList.add('was-validated');
}, false);
});
}, false);
})();
</script>
@endsection