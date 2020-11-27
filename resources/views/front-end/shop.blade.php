@extends('front-end.layout')



@section('content')
      <!-- CONTENT section START-->
	  <div class="container shop">
        <div class="row">
            <div class="col-3">
                <div class="shop-category">
					<h2>Kategorijos</h2>
					@if(Route::current()->getName() == 'search.category')
							@foreach($subCats as $subC)
									
									<a href="{{route('search.subcategory', $subC->id )}}">{{$subC->name}}</a>
										@endforeach
							@elseif(Route::current()->getName() == 'search.subcategory')	
							@foreach($subCats as $subC)
								
									<a href="{{route('search.subsubcategory', $subC->id )}}">{{$subC->name}}</a>
										@endforeach

										@elseif(Route::current()->getName() == 'search.subsubcategory')	
							@foreach($subCats as $subC)
								
									<a href="{{route('search.subsubcategory', $subC->id )}}">{{$subC->name}}</a>
										@endforeach
										
							@else
							@foreach($categories as $subC)
									
									<a href="{{route('search.category', $subC->id )}}">{{$subC->name}}</a>
										@endforeach
							@endif

                </div>
                <!-- <div class="price-filer">
                    <h2>Kainos filtras:</h2>
                    <input type="text" id="sampleSlider" />
                </div> -->




            </div>
            <div class="col-9">
                <div class="sort-container">
                    <select class="sort" name="sort" id="">
                                      <option disabled selected>Rušiuoti pagal:</option>
                                     <option data-sort="price:asc">Pigiausia viršuje</option>
                                    <option data-sort="price:desc">Brangiausia viršuje</option>
                                </select>
                </div>
                <div class="shop-items-container">

				@foreach($products as $product)
				<div class="shop-item" data-price="{{(integer)$product->price}}">
                        <a class="" href="{{route('product.list', $product->id)}}">
                            <img src="{{asset('images/' . $product->image)}}" alt="">
                            <div class="kaina-item"> {{$product->price}}€</div>
                            <h2> {{$product->name}}</h2>
                        </a>
                        <!-- <button type="button" class="shop-add-to-cart-btn" data-toggle="modal" data-target="#exampleModalCenter">
                                                Į Krepšelį
                                              </button> -->
                    </div>
				@endforeach

                    

                

                   
                 







                </div>
                {{$products->links()}}
            </div>
        </div>



    </div>

    <!-- Modal -->
  
    <!-- show Kategory section-->


@endsection

@section('scripts')

<script>
        $( document ).ready(function($) {
            "use strict";

            $.fn.numericFlexboxSorting = function(options) {
                const settings = $.extend({
                    elToSort: ".shop-items-container .shop-item"
                }, options);

                const $select = $('select[name ="sort"]')
                const ascOrder = (a, b) => a - b;
                const descOrder = (a, b) => b - a;

                $select.on("change", () => {
                    const selectedOption = $select.find("option:selected").attr("data-sort");
                    sortColumns(settings.elToSort, selectedOption);
                });

                function sortColumns(el, opt) {
					
                    const attr = "data-" + opt.split(":")[0];
                    const sortMethod = (opt.includes("asc")) ? ascOrder : descOrder;
                    const sign = (opt.includes("asc")) ? "" : "-";

                    const sortArray = $(el).map((i, el) => $(el).attr(attr)).sort(sortMethod);

                    for (let i = 0; i < sortArray.length; i++) {
						console.log( $(el).filter(`[${attr}="${sortArray[i]}"]`));
						

                        $(el).filter(`[${attr}="${sortArray[i]}"]`).css("order", sign + sortArray[i]);
                    }
                }
				
                return $select;
            };
		$(".b-select").numericFlexboxSorting();	
        }
		
		);

        // call the plugin
		
        
    </script>


    <!-- <script src="{{ asset('frontend/range-slider/js/rSlider.min.js')}}"></script>
    <script>
       
     

        var mySlider = new rSlider({
            target: '#sampleSlider',
            values: {
                min: minVal,
                max: maxVal
            },
            step: 1,
            range: true,
            set: [minVal, maxVal],
            scale: true,
            labels: false,
            onChange: function(vals) {
                let values = vals.split(",");
                $(".shop-item").each(function(el) {
                    let x = $(this).data('price');
                    if (x >= values[0] && x <= values[1]) {
                        $(this).show()
                    } else {
                        $(this).hide()
                    }
                })
                let x = 90;
                if (x >= values[0] && x <= values[1]) {}
            }
        });
    </script> -->



    <script>
        $(document).ready(function() {
            $("#form-control").prop("selectedIndex", -1);
        });
    </script>
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