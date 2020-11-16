@extends('admin.layout')

@section('content')

<div class="sl-mainpanel">

order :
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">payment</th> 
      <th scope="col">price</th>  
      <th scope="col">status</th>  
    </tr>
  </thead>
  <tbody>
    <tr>
      
      <td> {{$order->payment}}  </td>    
      <td> {{$order->price}}   </td>
      <td> 
      @if($order->status == 1)
        neapmoketa
        @elseif($order->status == 2)
        apmoketa
        @elseif($order->status == 3)
        paruostas
       @endif  </td>
    </tr>
    
  </tbody>
</table>


shipping details:
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">name</th>
      <th scope="col">adress</th>  
      <th scope="col">phone</th>  
      <th scope="col">email</th>  
    </tr>
  </thead>
  <tbody>
    <tr>
      
      <td> {{$order->shipping->name}}  , {{$order->shipping->lastName}} </td>
      <td> {{$order->shipping->address}} , {{$order->shipping->city}}   </td>
      <td> {{$order->shipping->phoneNumber}}   </td>
      <td>  {{$order->shipping->email}}  </td>
    </tr>
    
  </tbody>
</table>

<br>
<br>
order details:
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">product_id</th>  
      <th scope="col">variants</th>
      <th scope="col">kiek</th>  
    </tr>
  </thead>
  <tbody>
  @foreach($order->details as $item)
    <tr>
      <td>   {{$item->name}}  </td>
      <td>   {{$item->product_id}}  </td>
      <td>   {{$item->variants}} </td>
      <td>   {{$item->qnt}}  </td>
    </tr>
    @endforeach
  </tbody>
</table>



@if($order->status == 2)
<form action="{{route('orders.ready', [$order])}}" method="post" >
@csrf
<button type="submit"  >uzsakymas paruostas</button>
</form>
@endif
</div>
@endsection