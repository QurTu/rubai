@extends('admin.layout')

@section('content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Prideti nauja kategorija
</button>
      </nav>
   

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">actions</th>
     
    </tr>
  </thead>
  <tbody>
  @foreach($variants as $variant)
    <tr>
      <th scope="row">{{$variant->name}} </th>
      <td>
      <form action="{{route('variant.delete', [$variant])}}" method="post">
      @csrf
      <button type="submit">Delete</button>
      </form>
      <form action="{{route('variant.edit', [$variant])}}" method="get">
      <button type="submit">edit</button>
      </form>
      </td>
    </tr>
    @endforeach
    
  </tbody>
</table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Prideti nauja kategorija</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('variant.add')}}" method='post'>   
        @csrf
        <label for="variant_name"> Nauja Kagegorija  </label>
        <input type="text" name="name" id='variant_name' >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">prideti</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection