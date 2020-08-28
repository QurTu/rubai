@extends('admin.layout')

@section('content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
  
      </nav>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">actions</th>
     
    </tr>
  </thead>
  <tbody>
  <form action="{{route('variant.update', [$variant])}}" method="post">
    <tr>
      <th scope="row"> <input type="text" name="name" value='{{$variant->name}}'></th>
      <td>
      @csrf
      <button type="submit">Change name</button>
      
      </td>
    </tr>
    </form>
     
    <table class="table">
    <div> Variacijos savybes</div>
    <nav class="breadcrumb sl-breadcrumb">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Prideti nauja savybes variacija
</button>
      </nav>
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">actions</th>
     
    </tr>
  </thead>
  <tbody>
  
    <tr>
    @foreach($variantOptions as $variant_option)
    <tr>
      <th scope="row">{{$variant_option->name}}</th>
      <td>
      <form action="{{route('variant.options.delete', [$variant_option])}}" method="post">
      @csrf
      <button type="submit">Delete</button>
      </form>

      <form action="{{route('variant.options.edit', [$variant_option])}}" method="get">
      <button type="submit">edit</button>
      </form>
      </td>
    </tr>
    @endforeach
    </form>

   
    
  </tbody>
</table>
</div>
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
        <form action="{{route('variant.options.add')}}" method='post'>   
        @csrf
        <label for="variant_name">  nauja savybes variacija  </label>
        <input type="text" name="name" id='variant_name' >
        <input type="hidden" name="variant_id" value="{{$variant->id}}">
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