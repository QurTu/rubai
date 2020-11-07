@extends('front-end.layout')



@section('content')

<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="cart_container">
						<div class="cart_title">Shipping Adress</div>
						<div class="cart_items">
							<ul class="cart_list">

							@foreach($shipping as $item)
								<li class="cart_item clearfix">
								
									
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">name</div>
											<div class="cart_item_text"> {{$item->name}} {{$item->lastName}}</div>
											
										</div>
										
										
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Price</div>
											<div class="cart_item_text">{{$item->address}}, {{$item->city}}</div>
										</div>
										
										<div class="cart_item_quantity cart_info_col">
                                        <form action="{{route('shipping.edit', [$item])}}" method="get">   
											<div class="cart_item_title">Update</div>
											<div class="cart_item_text"> <button type="submit">Edit</button> </div>
                                        </form>

										</div>
										<div class="cart_item_quantity cart_info_col">
                                        <form action="{{route('shipping.delete',[$item])}}" method="post">   
                                        @csrf
											<div class="cart_item_title">remove</div>
											<div class="cart_item_text"> <button type="submit">Remove</button> </div>
                                        </form>
										</div>
									</div>
								</li>
								@endforeach
							</ul>
						</div>
						
                        <div class="cart_buttons">
							<form action="" method="get">
							@csrf    
							<button type="submit" class="button cart_button_checkout">pasirinkti shipping adresa</button>
							</form>

						</div>


	   

						<!-- Order Total -->
						

					</div>
				</div>
			</div>
		</div>
	</div>




@endsection