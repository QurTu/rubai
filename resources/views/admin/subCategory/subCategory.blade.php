

@extends('admin.layout')
@section('content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Prideti nauja sub-kategorija
</button>
      </nav>
   

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">sub-category</th>
      <th scope="col">category</th>
      <th scope="col">actions</th>
     
    </tr>
  </thead>
  <tbody>
  @foreach($subCategories as $Subcategory)
    <tr>
      <th scope="row">{{$Subcategory->name}}</th>
      <th scope="col">{{ $Subcategory->subCategoryBelongs->name}}</th>
      <td>
      <form action="{{route('subcategory.delete', [$Subcategory])}}" method="post">
      @csrf
      <button type="submit">Delete</button>
      </form>
      <form action="{{route('subcategory.edit', [$Subcategory])}}" method="get">
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
        <h5 class="modal-title" id="exampleModalCenterTitle">Prideti nauja Sub-kategorija</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('subcategory.add')}}" method='post'>   
        @csrf
        <label >  Kagegorija  </label>
        <select name="category_id">
        @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->name}} </option>
        @endforeach
        </select> <br> <br>
        <label for="Subcategory_name">  Sub-Kagegorija  </label>
        <input type="text" name="name" >
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