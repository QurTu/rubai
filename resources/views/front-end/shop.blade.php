@extends('front-end.layout')



@section('content')
	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">

					<!-- Shop Sidebar -->
					<div class="shop_sidebar">
						<div class="sidebar_section">
							<div class="sidebar_title">Categories</div>
							<ul class="sidebar_categories">
							@if(Route::current()->getName() == 'search.category')
							@foreach($subCats as $subC)
									<li class="hassubs">
									<a href="{{route('search.subcategory', $subC->id )}}">{{$subC->name}}<i class="fas fa-chevron-right"></i></a>
										@endforeach
							@elseif(Route::current()->getName() == 'search.subcategory')	
							@foreach($subCats as $subC)
									<li class="hassubs">
									<a href="{{route('search.subsubcategory', $subC->id )}}">{{$subC->name}}<i class="fas fa-chevron-right"></i></a>
										@endforeach

										@elseif(Route::current()->getName() == 'search.subsubcategory')	
							@foreach($subCats as $subC)
									<li class="hassubs">
									<a href="{{route('search.subsubcategory', $subC->id )}}">{{$subC->name}}<i class="fas fa-chevron-right"></i></a>
										@endforeach
										
							@else
							@foreach($categories as $subC)
									<li class="hassubs">
									<a href="{{route('search.category', $subC->id )}}">{{$subC->name}}<i class="fas fa-chevron-right"></i></a>
										@endforeach
							@endif



							
							</ul>
						</div>
						<div class="sidebar_section filter_by_section">
							<div class="sidebar_title">Filter By</div>
							<div class="sidebar_subtitle">Price</div>
							<div class="filter_price">
								<div id="slider-range" class="slider_range"></div>
								<p>Range: </p>
								<p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
							</div>
						</div>
						
					
					</div>

				</div>

				<div class="col-lg-9">
					
					<!-- Shop Content -->

					<div class="shop_content">
						<div class="shop_bar clearfix">
							<div class="shop_product_count"><span>186</span> products found</div>
							<div class="shop_sorting">
								<span>Sort by:</span>
								<ul>
									<li>
										<span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
										<ul>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
											<li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>

						<div class="product_grid">
							<div class="product_grid_border"></div>

						
						

							@foreach($products as $product)
							<!-- Product Item -->
							<div class="product_item is_new">
								<div class="product_border"></div>
								<div class="product_image d-flex flex-column align-items-center justify-content-center">
								<a href="{{route('product.list', $product->id)}}">   <img src="{{asset('images/' . $product->image)}}" alt=""> </a>  </div>
								<div class="product_content">
									<div class="product_price">{{$product->price}}</div>
									<div class="product_name"><div><a href="{{route('product.list', $product->id)}}" tabindex="0">{{$product->name}}
									</div></div>
									</a>
								</div>
								
								
							</div>
							@endforeach
						</div>

						<!-- Shop Page Navigation -->

						{{$products->links()}}

						

					</div>

				</div>
			</div>
		</div>
	</div>

@endsection