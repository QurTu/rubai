@extends('front-end.layout')



@section('content')
<div class="single_product">
		<div class="container">
			<div class="row">
			@foreach($products as $product)
				<!-- Images -->
				

				<!-- Selected Image -->
				<div class="col-lg-5 order-lg-2 order-1">
				<div class="image_selected"><img style="width:100%;" src="{{asset('images/' . $product->image)}}" alt=""></div>
					
				</div>

				<!-- Description -->
				
				<div class="col-lg-5 order-3">
					<div class="product_description">
						<div class="product_category">
						<a href="{{route('search.category', $product->category_id )}}">{{$product->category_name}} </a>  >
						<a href="{{route('search.subcategory', $product->sub_category_id )}}">{{$product->sub_category_name}}</a> >
						<a href="{{route('search.subsubcategory', $product->sub_sub_category_id )}}">{{$product->sub_sub_category_name}}</a>
						
						<form action="{{route('Cart.from.product')}}" method="post">  
						<input value='{{$product->id}}' type="hidden" name="product_id">
						<input value='{{$product->name}}' type="hidden" name="product_name">
						<input value='{{$product->price}}' type="hidden" name="product_price">
						<input value='{{$product->image}}' type="hidden" name="product_image">
						</div>
						<div class="product_name">{{$product->name}}</div>
						
						<div class="product_text"><p>{{$product->discription}}</p></div>
						<div class="order_info d-flex flex-row">
							
								<div class="clearfix" style="z-index: 1000;">

									

									<!-- Product Color -->
									@foreach($productVariant as $variant)
									

									<div class="form-group">
									<label for="">{{$variant->variant_name}}: </label>
									<select name='variant[{{$variant->variant_name}}]' class="form-control">
										<option >--pasirinkite--</option>
											@foreach($variant->options as $option)
											<option value="{{$option['name']}}"  data-qnt="{{$option['qnt']}}" @if( $option['qnt'] == 0 ) disabled @endif > {{$option['name']}} @if( $option['qnt'] == 0 ) (baigesi) @endif </option>
											@endforeach
										</select>
									</div>
									@endforeach

<!-- Product Quantity -->
								<div class="form-group">
								<label for="formGroupExampleInput">Kiekis:</label>
   								 <input type="number" name="product_qnt" min="1" value='1' class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
								
									</div>

									
									

								

								<div class="product_price">{{$product->price}}</div>
								<div class="button_container">
								@csrf
									<button type="submit" class="button cart_button">Add to Cart</button>
									<div class="product_fav"><i class="fas fa-heart"></i></div>
								</div>
								</form>
							
						</div>
					</div>
				</div>
	@endforeach
			</div>
		</div>
	</div>
@endsection


@section('scripts')


@foreach($productVariant as $variant)
<script type="text/javascript"> 
$('select[name="variant[{{$variant->variant_name}}]"]').on('change',function(){

          var input = this.options[this.selectedIndex].text;
		  var id = $('input[name="product_id"]').val();	
		  var name = '{{$variant->variant_name}}'; 
		  if (input) {
            $.ajax({
              url: "{{ url('/product/select/variants') }}/"+input + "/" + id + "/" + name ,
              type:"GET",
              dataType:"json",
              success:function(data) { 
				  console.log(data);
			   for (let i = 0; i < data.length; i++) {				
				$(`select[name="variant[${data[i].variant_name}]"] > option`).not(':first-child').each(function(it) {
					this.dataset.qnt= data[i].options[it].qnt;
					if(this.dataset.qnt == 0){						
						$(this).attr("disabled", true);
						this.text = data[i].options[it].name + '(baigesi)';
					}
					else {
						this.text = data[i].options[it].name ;
						if($(this).attr("disabled"))
						 {
							$(this).attr("disabled", false);
							}						
					}
					});
				   
			   }
              },
            });

          }else{
            alert('danger');
          }
      });

</script>
@endforeach

@endsection