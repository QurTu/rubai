@extends('front-end.layout')


@section('content')

<div class="container ">
        <div class="row">
            <div class="product-cart">
                <h1>Prekių Krepšelis</h1>
                <div class="row cart-upper">
                    <div class="col-5">
                        <h3> Prekė </h3>
                    </div>
                    <div class="col-2">
                        <h3> Savybės </h3>
                    </div>
                    <div class="col-1">
                        <h3>Vieneto Kaina</h3>
                    </div>
                    <div class="col-2">
                        <h3>Kiekis</h3>
                    </div>
                    <div class="col-2">
                        <h3>Bendra Kaina</h3>
                    </div>
				</div>
				@foreach($cart as $item)
                <div class="row cart-item">
                    <div class="col-5 cart-item-img-name"> <img src="{{asset('images/' . $item->options->image)}}" alt="">
                        <a href="{{route('product.list', $item->id)}}"> {{$item->name}}</a>
                    </div>
                    <div class="col-2">


					  <div class="cart-variants">
					@foreach($item->options as $key => $variant)
										@if($key != 'image')
										<div class="cart-variant">
										{{$key}}: <span>{{$variant}}</span>
                           				 </div>
										@endif
										@endforeach
                      
                            
                            
                        </div>
                    </div>
                    <div class="col-1 cart-item-price">{{$item->price}}€</div>
                    <div class="col-2">
                        <div class="cart-qty">
                            <i class="fas fa-minus"></i>
                            <h2>{{$item->qty}}</h2>
                            <i class="fas fa-plus"></i>
                        </div>
                    </div>
                    <div class="col-2 cart-item-price">{{$item->price * $item->qty}}€
						<div class="cart-remove">  
					<form action="{{route('remove.cart')}}" method="post">  
											<input type="hidden" name="rowId" value="{{$item->rowId}}" >
											@csrf
											 <button type="submit">
											  <i class="fas fa-trash"></i>	
											</button></div>
											</form>
						
						 </div>
                    
				</div>
				@endforeach
                
            </div>
        </div>
        <div class="row justify-content-end">
            <h1 class="cart-sum">Bendra Suma:<span><?php echo Cart::subtotal(); ?>€</span></h1>
        </div>
        <div class="row justify-content-end">
		<form action="{{route('shipping')}}" method="get">
							@csrf    
							<button  class="buy-button" type="submit">Pirkti</button>
							</form>
        </div>
    </div>


	
@endsection