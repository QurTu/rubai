@extends('admin.layout')

@section('content')

<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Prideti nauja savybes
</button>
      </nav>
   

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col">image</th>
      <th scope="col">category</th>
      <th scope="col">sub-category</th>
      <th scope="col">sub-sub-category</th>
      <th scope="col">actions</th>
     
    </tr>
  </thead>
  <tbody>
  @foreach($products as $product)
    <tr>
      <td scope="row">{{$product['id']}}</td>
      <td scope="row">{{$product['name']}}</td>
      <td img style="height:100px;width:120px;" scope="row"><img style="height:80px;width:120px;" src="{{asset('images/' . $product['image'])}}" alt=""> </td>
      <td scope="row">{{$product['category_name']}}</td>
      <td scope="row">{{$product['sub_category_name']}}</td> 
      <td scope="row">{{$product['sub_sub_category_name']}}</td>
      <td>
      <form action="{{route('product.delete', [$product['id'] ])}}" method="post">
      @csrf
      <button type="submit">Delete</button>
      </form>
      <form action="{{route('product.edit', [$product['id']])}}" method="get">
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
      <div class="modal-body ">
        <form action="{{route('product.add')}}"  method='post' enctype="multipart/form-data">   
        @csrf
        <label for="product_name"> Produkto pavadinimas:  </label>
        <input type="text" name="name" id='product_name' > <br>
        <label for="decreption"> Produkto aprasymas: </label>
        <textarea  id="summernote" name="decreption"></textarea> <br>
        <label for="image"> Nuotrauka:  </label>
        <input type="file" name="image" id="image"> <br>
            
      <div class="row row-cols-3">
        <div class="col">
      <label >  Kagegorija  </label>
        <select name="category_id">
        @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->name}} </option>
        @endforeach
        </select>
        </div>
        <div class="col"> 
        <label >  Sub-Kagegorija  </label>
        <select name="subcategory_id"  id='subcategory'>
            </select></div>
        <div class="col">   
        <label >  Sub-Sub-Kagegorija  </label>
        <select name="sub_subcategory_id"  id='subsubcategory'>
            </select></div>
        </div>
    </div>
    <div class="col">Column</div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">prideti</button>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>

<!-- ajax onload -->
<script type="text/javascript">
   $(document).ready(function(){
        let category_id =  $('select[name="category_id"]').val();
          if (category_id) {
            $.ajax({
              url: "{{ url('/get/subcategory') }}/"+category_id ,
              type:"GET",
              dataType:"json",
              success:function(data) { 
              var d =$('select[name="subcategory_id"]').empty();
              $.each(data[0][0], function(key, value){
              $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');
              });
              },
            }).done( function(){
        let subcategory_id =  $('select[name="subcategory_id"]').val();
        console.log(subcategory_id);
          if (subcategory_id) {
            $.ajax({
              url: "{{ url('/get/subsubcategory') }}/"+subcategory_id ,
              type:"GET",
              dataType:"json",
              success:function(data) { 
                console.log(data);
              var d =$('select[name="sub_subcategory_id"]').empty();
              $.each(data[0][0], function(key, value){
              $('select[name="sub_subcategory_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');
              });
              },
            });
          }else{
            alert('danger');
          } });
          }else{
            alert('danger');
          }
        });
</script>



<!-- ajax onchange -->
<script type="text/javascript">
      $(document).ready(function(){
     $('select[name="category_id"]').on('change',function(){
          var category_id = $(this).val();
          if (category_id) {
            $.ajax({
              url: "{{ url('/get/subcategory') }}/"+category_id  ,
              type:"GET",
              dataType:"json",
              success:function(data) { 
              var d =$('select[name="subcategory_id"]').empty();
              
              $.each(data[0][0], function(key, value){
              $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');
              });
              },
            }).done(function(){
             let subcategory_id =  $('select[name="subcategory_id"]').val();     
          console.log(subcategory_id);
          if (subcategory_id) {
            $.ajax({
              url: "{{ url('/get/subsubcategory') }}/"+subcategory_id  ,
              type:"GET",
              dataType:"json",
              success:function(data) { 
                console.log(data);
              var d =$('select[name="sub_subcategory_id"]').empty();  
              $.each(data[0][0], function(key, value){
              $('select[name="sub_subcategory_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');
              });
              },
            });
          }else{
            alert('danger');
            var d =$('select[name="subcategory_id"]').empty();
          }
      })
          }else{
            alert('danger');
            
          }
            });
      });

 </script>
<script type="text/javascript">
      $(document).ready(function(){
     $('select[name="subcategory_id"]').on('change',function(){
          var subcategory_id = $(this).val();
          console.log(subcategory_id);
          if (subcategory_id) {
            $.ajax({
              url: "{{ url('/get/subsubcategory') }}/"+subcategory_id  ,
              type:"GET",
              dataType:"json",
              success:function(data) { 
                console.log(data);
              var d =$('select[name="sub_subcategory_id"]').empty();
              
              $.each(data[0][0], function(key, value){
              $('select[name="sub_subcategory_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');

              });
              },
            });

          }else{
            alert('danger');
          }

            });
          
      });
 </script>



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