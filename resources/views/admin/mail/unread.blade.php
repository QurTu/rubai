@extends('admin.layout')

@section('content')

<div class="sl-mainpanel">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">email</th>
      <th scope="col">actions</th>
     
    </tr>
  </thead>
  <tbody>
  @foreach($mail as $message)
    <tr>
      <td scope="row">{{$message->email}}</td>
      <td scope="row">neperskaityta</td>
      <td>
     
      </form>
      <form action="{{route('mail.details' , [$message])}}" method="get">
      <button type="submit">details</button>
      </form>
      </td>
    </tr>
    @endforeach
    
  </tbody>
</table>
</div>
@endsection