
@section('menu')
<div class="cat_menu_container">
								<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
									<div class="cat_burger"><span></span><span></span><span></span></div>
									<div class="cat_menu_text">Kategorijos</div>
								</div>

								<ul class="cat_menu">										
								@foreach($categories as $category)
									<li class="hassubs">
										<a href="{{route('search.category', $category->id )}}">{{$category->name}}<i class="fas fa-chevron-right"></i></a>
										<ul>
										@foreach($subCategories as $sub)
										@if($sub->category_id == $category->id) 
											<li class="hassubs">
												<a href="{{route('search.subcategory', $sub->id )}}">{{$sub->name}}<i class="fas fa-chevron-right"></i></a>
												<ul>
												@foreach($subSubCategories as $subsub)
												@if($subsub->sub_category_id == $sub->id )
												
													<li><a href="{{route('search.subsubcategory', $subsub->id )}}"><i class="fas fa-chevron-right"> </i> {{$subsub->name}}</a></li>
												@endif
												@endforeach
												</ul>
												@endif
											</li>
											@endforeach
										</ul>
									</li>
									@endforeach
								</ul>
							</div>
@endsection