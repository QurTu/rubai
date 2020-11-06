@extends('front-end.layout')


@section('content')
<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="cart_container">
						<div class="cart_title">Shopping Cart</div>
						<div class="cart_items">
							<ul class="cart_list">

							@foreach($cart as $item)
								<li class="cart_item clearfix">
								
									<div class="cart_item_image"> <img  src="{{asset('images/' . $item->options->image)}}" alt="aa"> </div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">name</div>
											<div class="cart_item_text"> {{$item->name}}</div>
											
										</div>


										@foreach($item->options as $key => $variant)
										@if($key != 'image')
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">{{$key}}</div>
											<div class="cart_item_text"> {{$variant}}</div>
										</div>
										@endif
										@endforeach


										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Quantity</div>
											<div class="cart_item_text"> {{$item->qty}}</div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Price</div>
											<div class="cart_item_text">{{$item->price}}</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Total</div>
											<div class="cart_item_text">{{$item->price * $item->qty}}</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Update</div>
											<div class="cart_item_text"> <button>Update</button>  </div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Remove</div>
											<form action="{{route('remove.cart')}}" method="post">  
											<input type="hidden" name="rowId" value="{{$item->rowId}}" >
											@csrf
											<div class="cart_item_text"> <button type="submit">Remove</button></div>
											</form>
										</div>
									</div>
								</li>
								@endforeach
							</ul>
						</div>
						
						<table>
   	<thead>
       	<tr>
           	<th>Product</th>
           	<th>Qty</th>
           	<th>Price</th>
           	<th>Subtotal</th>
       	</tr>
   	</thead>

   	<tbody>


	   

						<!-- Order Total -->
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Order Total:</div>
								<div class="order_total_amount"><?php echo Cart::subtotal(); ?></div>
							</div>
						</div>

						<div class="cart_buttons">
							<button type="button" class="button cart_button_clear">Add to Cart</button>
							<button type="button" class="button cart_button_checkout">Add to Cart</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	
@endsection