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

@endsection