@extends('front-end.layout')
@section('content')
<div class="container order-container">
    <h1>Užsakymo detalės:</h1>
    <div class="row order-details">
        <div class="col-md-4 mb-3">
            <h1>Pristatymas</h1>
            <h2>Kurjeriu į namus</h2>
        </div>
        <div class="col-md-4 mb-3">
            <h1>Pirkėjas</h1>
            <h2>{{$shipping->name}} {{$shipping->lastName}}</h2>
            <div>
                <i class="fas fa-phone"></i> {{$shipping->phoneNumber}}
            </div>
            <div>
                <i class="fas fa-map-marker-alt"></i> {{$shipping->address}}, {{$shipping->city}}
            </div>


        </div>
        <div class="col-md-4 mb-3">
            <h1>Mokėjimas</h1>
            <img src="{{asset('frontend/img/paysera.png')}}" alt="">
        </div>
    </div>
</div>

<div class="container ">
    <div class="row">
        <div class="product-cart">
            <h1>Prekės:</h1>
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

                        <h2>{{$item->qty}}</h2>

                    </div>
                </div>
                <div class="col-2 cart-item-price">{{$item->price * $item->qty}}€


                </div>

            </div>
            @endforeach

        </div>
    </div>
    <div class="row justify-content-end">
        <h1 class="cart-sum">Bendra Suma: <span><?php echo Cart::subtotal() ?>€</span></h1>
    </div>
    <div class="row justify-content-end">
        <form action="{{route('moketi')}}" method="post">
            @csrf
            <button class="buy-button" type="submit">Pirkti</button>
        </form>

    </div>
</div>
@endsection