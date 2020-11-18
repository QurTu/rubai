@extends('admin.layout')

@section('content')

<div class="sl-mainpanel">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">email</th>
      <th scope="col">phone</th>
      <th scope="col">status</th>
     
    </tr>
  </thead>
  <tbody>
  
    <tr>
    <td scope="row">{{$mail->name}}</td>
    <td scope="row">{{$mail->email}}</td>
      <td scope="row">{{$mail->phoneNumber}}</td>
      <td scope="row">
      @if($mail->status == 0) 
      neperskaityta/neatsakyta
        @else
        perskaityta/atsakyta
    @endif

      </td>
      <td>
     
      </td>
    </tr> 
  </tbody>
</table>

<div>  {{$mail->message}} </div>

@if($mail->status == 0) 
</form>
      <form action="{{route('mail.response' , [$mail])}}" method="post">
      @csrf
      <button type="submit">pazymeti kaip persakityta/atsakyta</button>
      </form>
</div>
    @endif
    
@endsection