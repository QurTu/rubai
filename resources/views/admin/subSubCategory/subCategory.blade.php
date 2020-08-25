

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
     <th scope="col">sub-sub-category</th>
      <th scope="col">sub-category</th>
      <th scope="col">category</th>
      <th scope="col">actions</th>
     
    </tr>
  </thead>
  <tbody>
  @foreach($subSubCategories as $Subcategory)
    <tr>
      <th scope="row">{{$Subcategory->name}}</th>
      <th scope="col">{{ $Subcategory->subSubCategoryBelongsSubCategory->name}}</th>
      <th scope="col">{{ $Subcategory->subSubCategoryBelongsCategory->name}}</th>
      <td>
      <form action="{{route('subsubcategory.delete', [$Subcategory])}}" method="post">
      @csrf
      <button type="submit">Delete</button>  
      </form>
      <form action="{{route('subsubcategory.edit', [$Subcategory])}}" method="get">
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
        <h5 class="modal-title" id="exampleModalCenterTitle">Prideti nauja sub-subkategorija</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('subsubcategory.add')}}" method='post'>   
        @csrf
        <div class="form-group">   
            <label >  Kategorija  </label> 
           <select name="category_id" id='category'>
               @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}} </option>
                @endforeach
          </select> <br> 
          </div>
            <div class="form-group">  
        <label >  Sub-Kategorija  </label>
        <select name="subcategory_id" name="subcategory" id='subcategory'>
            
       
        </select> <br> <br>
        </div>
        <label for="Subcategory_name">  Sub-SubKagegorija  </label>
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

<script type="text/javascript">
      $(document).ready(function(){
        let category_id =  $('select[name="category_id"]').val();
          if (category_id) {
            $.ajax({
              url: "{{ url('/get/subcategory') }}/"+category_id ,
              type:"GET",
              dataType:"json",
              success:function(data) { 
                console.log(data);
              var d =$('select[name="subcategory_id"]').empty();
              $.each(data[0][0], function(key, value){
              $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');
              });
              },
            });
          }else{
            alert('danger');
          }
     $('select[name="category_id"]').on('change',function(){
          var category_id = $(this).val();
          console.log(category_id);
          if (category_id) {
            $.ajax({
              url: "{{ url('/get/subcategory') }}/"+category_id  ,
              type:"GET",
              dataType:"json",
              success:function(data) { 
                console.log(data);
              var d =$('select[name="subcategory_id"]').empty();
              
              $.each(data[0][0], function(key, value){
              $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');

              });
              },
            });

          }else{
            alert('danger');
          }

            });
      });

 </script>

@endsection