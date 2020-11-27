@extends('front-end.layout')
@section('content')
<div class="home-hero">

</div>

<!-- show Kategory section-->
@foreach($categoriesWithProducts as $catWithProducts)
<div class="container">
	<div class="row category-row">
		<h2>{{$catWithProducts->name}}</h2>
		<a href="{{route('search.category', $catWithProducts->id )}}">   visos {{$catWithProducts->name}} prekes </a> </div>
	<div class="row ">
		<div class="items-row">
		@foreach($catWithProducts->products as $product)
			<a class="whole-item" href="{{route('product.list', $product->id)}}">
				<div class="item">
					<img src="{{asset('images/' . $product['image'])}}" alt="">
					<div class="kaina-item"> {{$product->price}}€</div>
					<h2> {{$product->name}}</h2>
				</div>
			</a>
		@endforeach
						</div>
	</div>
</div>
@endforeach

@if($payment == 1)
<!-- Thanks for buying model -->
<div class="modal fade" id="thanksMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Užsakymą gavome</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>
                   <div class="modal-body">

                    <h1>Ačiū, kad pirkote!!!</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Uždaryti</button>
                </div>
            </div>
        </div>
    </div>
@endif

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        cancel
      </button>
	  @if($payment == 0)
    <!-- cancel payment model-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Įvyko Klaida</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>
                <div class="modal-body">
                    <h1>Apmokant įvyko klaida arba mokėjimas buvo nutrauktas</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Uždaryti</button>

                </div>
            </div>
        </div>
    </div>
	@endif
	
@endsection

@section('scripts')
@if($payment == 1)
<script type="text/javascript">
        $(window).on('load', function() {
            $('#thanksMessage').modal('show');
            console.log('wroks')
        });
	</script>
	@endif
	  @if($payment == 0)
	<script type="text/javascript">
        $(window).on('load', function() {
            $('#exampleModalCenter').modal('show');
            console.log('wroks')
        });
    </script>
		@endif
@endsection