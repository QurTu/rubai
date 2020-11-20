@extends('admin.layout')

@section('content')
  <!-- Table css -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

<div class="sl-mainpanel">
<div style='width: 80%; padding-left:10%;' >   
      <nav class="breadcrumb sl-breadcrumb">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Prideti nauja kategorija
</button>
      </nav>
   

<table id="dtBasicExample" class="table table-striped table-bordered table-sm  " cellspacing="0" width="100%">
  <thead class="">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
     
    </tr>
  </thead>
  <tbody>
  @foreach($categories as $category)
    <tr>
      <td scope="row">{{$category->name}}</td>
    <td> 
        <form action="{{route('category.edit', [$category])}}" method="get">
        <button type="submit">edit</button>
        </form>
        </td>
      <td>
      <button type="button" class="btn btn-danger" data-toggle="modal"  onclick="deletemodel({{$category->id}})" data-target="#delete-model">
        Delete
      </button>
      


      
      </td>
    
    </tr>
    @endforeach
    
  </tbody>
</table>
</div>
</div>
<!-- Create Modal -->
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
        <form action="{{route('category.add')}}" method='post'>   
        @csrf
        <label for="category_name"> Nauja Kagegorija  </label>
        <input type="text" name="name" id='category_name' >
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
        <form action="{{route('category.delete')}}" method="post">
         <input type="hidden" name='category_id' type="text">
      @csrf
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