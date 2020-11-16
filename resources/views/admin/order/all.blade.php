@extends('admin.layout')

@section('content')

<div class="sl-mainpanel">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Order_id</th>
      <th scope="col">status</th>
      <th scope="col">actions</th>
     
    </tr>
  </thead>
  <tbody>
  @foreach($orders as $order)
    <tr>
      <td scope="row">{{$order->id}}</td>
      <td scope="row">{{$order->status}}</td>
      <td>
     
      </form>
      <form action="{{route('orders.edit' , [$order])}}" method="get">
      <button type="submit">edit</button>
      </form>
      </td>
    </tr>
    @endforeach
    
  </tbody>
</table>
</div>
@endsection