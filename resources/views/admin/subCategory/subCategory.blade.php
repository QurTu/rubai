

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
     

      <button type="button" class="btn btn-danger" data-toggle="modal"  onclick="deletemodel({{$Subcategory->id}})" data-target="#delete-model">
        Delete
      </button>

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

<!--Delete Modal -->
<div class="modal fade" id="delete-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        <form action="{{route('subcategory.delete')}}" method="post">
      @csrf
       <input type="hidden" name='category_id' type="text">
      <button type="submit">Delete</button>
      </form>



      
      </div>
    </div>
  </div>
</div>

@endsection


@section('scripts')
<script type="text/javascript">
            $(document).ready( function () {
                $('#dtBasicExample').DataTable();
            } );
                </script>

<script>
       function deletemodel(id){
     $('input[name ="category_id"]').val(id) ;
       
        }
    </script>
@endsection