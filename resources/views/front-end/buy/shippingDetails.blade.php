@extends('front-end.layout')



@section('content')

 <!-- CONTENT section START-->
   @if($shipping->isNotEmpty())
 <div class="container shipping-add">
        <form action="{{route('shipping.fromList')}}" method="post" class="needs-validation" novalidate>
			@csrf
			<h1>Pasirinkinte Pristatymo Duomenis:</h1>
			@foreach($shipping as $item)
            <div class="row pristatymo-duomenys">
			
                <div class="col-md-6 mb-3 d-flex">
                    <input type="radio" name="shipping" value="{{$item->id}}" checked="checked" required>
                    <div class="shipping-person-details">
                        <div class="shipping-person">
						{{$item->name}} {{$item->lastName}} 

                        </div>

                        <div class="shipping-contacts">
                            <i class="fas fa-phone"></i>  {{$item->phoneNumber}} 
                        </div>
                    </div>

                </div>
                <div class="col-md-6 mb-3">
                    <div class="shipping-address">
                        <i class="fas fa-map-marker-alt"></i> {{$item->address}}, {{$item->city}}
                    </div>
                </div>

            </div>
			@endforeach


            <button class="buy-button" type="submit">Pasirinkti Duomenis</button>

        </form>
    </div>


 

@endif



    <form action="/action_page.php">
        <input type="radio" name="vehicle" value="Bike">


    </form>

    <div class="container shipping-add">
        <h1>Nauji Pristatymo Duomenys:</h1>

        <form class="needs-validation" action="{{route('shipping.add')}}" method="post" novalidate>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom01">Vardas</label>
                    <input type="text" name='name' class="form-control" id="validationCustom01" placeholder="vardas" value="" required>

                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">Pavardė</label>
                    <input type="text" name='lastName' class="form-control" id="validationCustom02" placeholder="pavardė" value="" required>
                </div>

            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">Telefono numeris</label>
                    <input type="text" name='phone' class="form-control" id="validationCustom06" placeholder="" value="" required>

                </div>


                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">Elektroninis paštas</label>
                    <input type="text" name='email' class="form-control" id="validationCustom06" placeholder="" value="" required>

                </div>
            </div>

            <div class="form-row">

                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Adresas</label>
                    <input type="text" name='address' class="form-control" id="validationCustom03" placeholder="" required>

                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">Miestas</label>
                    <input type="text" name='city' class="form-control" id="validationCustom04" placeholder="" required>
                    <div class="invalid-feedback">
                        Please provide a valid state.
                    </div>

                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom05">Pašto kodas</label>
                    <input type="text" name='zip' class="form-control" id="validationCustom05" placeholder="" required>
                    <div class="invalid-feedback">
                        Please provide a valid zip.
                    </div>
                </div>

            </div>


@csrf
            <button class="buy-button" type="submit">Nuadoti naujus duomenis</button>
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