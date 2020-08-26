@extends('admin.layout')

@section('content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Prideti nauja produkta
</button>
      </nav>
   

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col">image</th>
      <th scope="col">actions</th>
     
    </tr>
  </thead>
  <tbody>
  @foreach($products as $product)
    <tr>
      <td scope="row">{{$product->id}}</td>
      <td scope="row">{{$product->name}}</td>
      <td scope="row">image</td>
      <td>
      <form action="{{route('product.delete', [$product])}}" method="post">
      @csrf
      <button type="submit">Delete</button>
      </form>
      <form action="{{route('product.edit', [$product])}}" method="get">
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
        <h5 class="modal-title" id="exampleModalCenterTitle">Prideti nauja produkta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('product.add')}}" method='post'>   
        @csrf
        <label for="product_name"> Produkto pavadinimas:  </label>
        <input type="text" name="name" id='product_name' > <br>
        <label for="decreption"> Produkto aprasymas:  </label>
        <textarea  id="summernote" name="decreption"></textarea> <br>
        <label for="image"> Nuotrauka:  </label>
        <input type="file" name="image" id="image">
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">prideti</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
      $('#summernote').summernote({
        placeholder: 'iveskite produkto aprasyma',
        tabsize: 2,
        height: 100
      });
      </script>
@endsection