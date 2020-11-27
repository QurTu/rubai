@extends('front-end.layout')

@section('content')



<form action="/action_page.php">
        <input type="radio" name="vehicle" value="Bike">


    </form>

    <div class="container shipping-add">
        <h1>Susitiekite su mumis:</h1>

        <form class="needs-validation" action="{{route('shipping.add')}}" method="post" novalidate>
			@csrf
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationCustom01">Vardas</label>
                    <input type="text" name='name' class="form-control" id="validationCustom01" placeholder="vardas" value="" required>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom02">Elektroninis paštas</label>
                    <input type="text" name='email' class="form-control" id="validationCustom06" placeholder="Elektroninis paštas" value="" required>
                </div>


                <div class="col-md-4 mb-3">
                    <label for="validationCustom02">Telefono numeris</label>
                    <input type="text" name='phone' class="form-control" placeholder="telefono numeris" value="">

                </div>



            </div>

            <div class="form-row">

                <div class="col-md-12 mb-3">
                    <label for="validationCustom03">Žinutė</label>
                    <textarea name="message" id="" cols="30" class="form-control" id="validationCustom03" placeholder="žinutė" required rows="10"></textarea>


                </div>



            </div>



            <button class="buy-button" type="submit">Siųsti Žinutę</button>
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