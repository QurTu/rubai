
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="{{ asset('frontend/fontawesome/css/all.css')}}" rel="stylesheet">
    <!--load all styles -->
    <link rel="stylesheet" href="{{ asset('frontend/mega/css/reset.css')}}">
    <!-- CSS reset -->
    <link rel="stylesheet" href="{{ asset('frontend/mega/css/style.css')}}">
    <!-- Resource style -->
</head>

<body>
    <!-- upper hero -->
    <!-- guest  -->
@guest
    <div class="login-border">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="logins">
                        <a class="loginas" href="{{route('login')}}">Login</a>
                        <a class="loginas" href="{{route('register')}}">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	@endguest
    <!-- for user -->
	@auth
    <div class="login-border">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="logins">
                        <div class="dropdown">
                            <i class="fas fa-user"></i>
                            <div class="loginas2">{{Auth::user()->name}}</div>
                            <div class="dropdown-content profile">
                                <a class="profile-link" href="#">Link 1</a>
								<a class="profile-link" href="#">Link 2</a>
								 <form action="{{route('logout')}}" method="post">
								@csrf
								<button type="submit">   Log Out</button>
								</form>
                               </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	@endauth

    <!-- search section -->
    <div class="container">
        <div class="row  row-search">
            <div class="col-md-6 mb-3">
                <div class="header_search">
                    <div class="header_search_content">
                        <div class="header_search_form_container">
                            <form action="{{route('search')}}" class="header_search_form clearfix" method="get">
								<input type="search" class="header_search_input" placeholder="Ieškoti produktu...">								                                                                 
                                <button type="submit" class="header_search_button trans_300" value="search"><img src="{{ asset('frontend/img/search.png')}}" alt=""></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- cart/wishlist -->
            <div class="col-3  cart-wishlist">
                <div class="dropdown">
                    <a href="">
                        <div class="wishlist">
                            <i class="far fa-heart"></i>
                            <div>
                                <div class="cart-first-word">Patikusios </div>
                                <div class="cart-second-word">prekės </div>
                    </a>
                    <div class="dropdown-content">
                        <div class="item">
                            <img src="./img/adv_1.png" alt="koja">
                            <a href=""> nameddddddddddddddddd
                          dddddddddddddddd<span>(1)</span> </a>
                            <button class="remove-from-cart">     <i class="fas fa-times"></i> </button>
                        </div>
                       
                        <div class="cartinfo">
                            Įsidėjote <span>1</span> prekių už <span>150€</span>
                        </div>
                        <button class="cart-button"><a href="">Patikusiu preikiu sarasas</a></button>

                    </div>
                    </div>
                    </div>
                </div>
                <a href="">
                    <div class="dropdown">
                        <div class="cart">
                            <i class="fas fa-shopping-cart"></i>
                            <div>
                                <div class="cart-first-word">Prekių </div>
                                <div class="cart-second-word">Krepšelis </div>
                </a>
                <div class="dropdown-content">
                    <div class="item">
                        <img src="./img/adv_1.png" alt="koja">
                        <a href=""> nameddddddddddddddddd
                          dddddddddddddddd<span>(1)</span> </a>
                        <button class="remove-from-cart">     <i class="fas fa-times"></i> </button>
                    </div>
               
                    <div class="cartinfo">
                        Įsidėjote <span>1</span> prekių už <span>150€</span>
                    </div>
                    <button class="cart-button"><a href="">Pirkti prekias</a></button>

                </div>
                </div>

                </div>
                </div>
            </div>

        </div>
    </div>
    <!-- menu -->



    <div class=" menu-cont ">
        <div class="menu-border">
            <div class="container ">
                <!-- category -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="cd-dropdown-wrapper">
                            <a class="cd-dropdown-trigger" href="#0">Kategorijos</a>
                            <nav class="cd-dropdown">
                                <h2>Kategorijos</h2>
                                <a href="#0" class="cd-close">Close</a>
                                <ul class="cd-dropdown-content">
								@foreach($categories as $category)
                                    <li class="has-children">
                                        <a class="katmenu" href="{{route('search.category', $category->id )}}">{{$category->name}}</a>
                                        <ul class="cd-secondary-dropdown is-hidden">
                                            <li class="go-back"><a class="katmenu" href="#0">Menu</a></li>
											<li class="see-all"><a class="katmenu" href="{{route('search.category', $category->id )}}">Visos {{$category->name}}</a></li>
											@foreach($subCategories as $sub)
										    	@if($sub->category_id == $category->id) 
                                            <li class="has-children">
												<a href="{{route('search.subcategory', $sub->id )}}">{{$sub->name}}</a>
												
                                                <ul class="is-hidden">
                                                    <li class="go-back"><a class="katmenu" href="#0">Clothing</a></li>
													<li class="see-all"><a class="katmenu" href="{{route('search.subcategory', $sub->id )}}">Visi {{$sub->name}}</a></li>
													@foreach($subSubCategories as $subsub)
												@if($subsub->sub_category_id == $sub->id )
													<li><a class="katmenu" href="{{route('search.subsubcategory', $subsub->id )}}">{{$subsub->name}}</a></li>
													@endif
												@endforeach
                                                </ul>
											</li>
											@endif
											@endforeach
                                        </ul>
                                        <!-- .cd-secondary-dropdown -->
									</li>
									@endforeach
                                    <!-- .has-children -->
                                </ul>
                                <!-- .cd-dropdown-content -->
                            </nav>
                            <!-- .cd-dropdown -->
                        </div>
                        <!-- .cd-dropdown-wrapper -->
                    </div>
                    <!-- menu-near category -->
                    <div class="col-md-8 mb-3">
                        <div class="main-menu">
                            <a href="">Susisiekti</a>
                            <a href="{{route('shop')}}">Visos prekes</a>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header section END-->
    <!-- CONTENT section START-->

@yield('content')

   

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

    <script src="{{ asset('frontend/mega/js/jquery.menu-aim.js')}}"></script>
    <script src="{{ asset('frontend/mega/js/main1.js')}}"></script>
    <!-- menu aim  rasyti main2 jei home routas-->
@yield('scripts')
</body>

</html>
