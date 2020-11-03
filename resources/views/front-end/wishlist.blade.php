@extends('front-end.layout')


@section('content')
<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="cart_container">
						<div class="cart_title">Wish List</div>
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
										
										
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Price</div>
											<div class="cart_item_text">{{$item->price}}</div>
										</div>
										
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Update</div>
											<div class="cart_item_text"> <button>Add To Cart</button>  </div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Remove</div>
											<div class="cart_item_text"> <button>Remove</button></div>
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
						

					</div>
				</div>
			</div>
		</div>
	</div>



	
@endsection