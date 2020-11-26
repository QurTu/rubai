@extends('front-end.layout')



@section('content')
   <!-- CONTENT section START-->
   @foreach($products as $product)
   <div class="container product-container">
        <div class="row">
            <div class="col-6 ">
                <img src="{{asset('images/' . $product->image)}}" alt="">
            </div>

            <div class="col-6 ">
                <p><a href="{{route('search.category', $product->category_id )}}">{{$product->category_name}} </a>  >
						<a href="{{route('search.subcategory', $product->sub_category_id )}}">{{$product->sub_category_name}}</a> >
						<a href="{{route('search.subsubcategory', $product->sub_sub_category_id )}}">{{$product->sub_sub_category_name}}</a>
					 </p>
                <h1>{{$product->name}}</h1>
                <form action="{{route('Cart.from.product')}}" method="post" class="needs-validation" novalidate>
						<input value='{{$product->id}}' type="hidden" name="product_id">
						<input value='{{$product->name}}' type="hidden" name="product_name">
						<input value='{{$product->price}}' type="hidden" name="product_price">
						<input value='{{$product->image}}' type="hidden" name="product_image">
				@foreach($productVariant as $variant)
                    <div class="form-group">
                        <label for="">{{$variant->variant_name}}: </label>
                        <select name='variant[{{$variant->variant_name}}]' required aria-describedby="inputGroupPrepend" class="form-control">                             
                                    <option disabled selected value> -- pasirinkite -- </option>
                                    @foreach($variant->options as $option)
										<option value="{{$option['name']}}"  data-qnt="{{$option['qnt']}}" @if( $option['qnt'] == 0 ) disabled @endif > {{$option['name']}} @if( $option['qnt'] == 0 ) (baigesi) @endif </option>  
										@endforeach
                                    </select>
                        <div class="invalid-feedback">
                            Pasirinkite savybe
                        </div>
                    </div>
					@endforeach

                    <!-- Product Quantity -->
                    <div class="form-group">
                        <label for="formGroupExampleInput">Kiekis:</label>
                        <input type="number" name="product_qnt" min="1" value='1' required class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
                        <div class="invalid-feedback">
                            maziausais galiams pasirinkimas 1
                        </div>
                    </div>
                    <h2>56.56 €</h2>
					@csrf
									<button type="submit" class="button cart_button">i Krepšelis</button>
                   
                </form>
            </div>
        </div>
        <div class="desciption">
            <h2>Prekes aprašymas</h2>
            <p>{{$product->discription}}</p>
        </div>
    </div>
@endforeach
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

          }
      });

</script>
@endforeach

@endsection