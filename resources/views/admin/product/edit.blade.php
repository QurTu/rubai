@extends('admin.layout')

@section('content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
  

      </nav>

      <div class="modal-body ">
        <form action="{{route('product.update' , [$product])}}"  method='post' enctype="multipart/form-data">   
        @csrf
        <label for="product_name"> Produkto pavadinimas:  </label>
        <input type="text" name="name" id='product_name' value="{{$product->name}}" > <br>
        <label for="decreption"> Produkto aprasymas: </label>
        <textarea  id="summernote" name="decreption" > {{$product->discription}}</textarea> <br>
        <label for="image"> Nuotrauka:  </label>
        <input type="file" name="image" id="image"> <br>
            
      <div class="row row-cols-3">
        <div class="col">
      <label >  Kagegorija  </label>
        <select name="category_id">
        @foreach ($categories as $category)
            <option value="{{$category->id}}"  @if($category->id == $product->category_id ) selected @endif>{{$category->name}} </option>
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

<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
      $('#summernote').summernote({
        placeholder: 'iveskite produkto aprasyma',
        tabsize: 2,
        height: 100
      });
      </script>

<!-- ajax onload -->
<script type="text/javascript">
   $(document).ready(function(){
        let category_id =  $('select[name="category_id"]').val();
        let name =  $('input[name="name"]').val();
          if (category_id) {
            $.ajax({
              url: "{{ url('/get/subcategory/product') }}/"+category_id + "/" + name,
              type:"GET",
              dataType:"json",
              success:function(data) { 
              var d =$('select[name="subcategory_id"]').empty();
              $.each(data[0], function(key, value){
              if(data[1].sub_category_id == value.id) {
                  
              $('select[name="subcategory_id"]').append('<option value="'+ value.id + '" selected>' + value.name + '</option>');
               }
                else {
                  $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');
                }


            
              });
              },
            }).done( function(){
        let subcategory_id =  $('select[name="subcategory_id"]').val();
        let name =  $('input[name="name"]').val();
          if (subcategory_id) {
            $.ajax({
              url: "{{ url('/get/subsubcategory/product') }}/"+subcategory_id + "/" + name,
              type:"GET",
              dataType:"json",
              success:function(data) { 
              var d =$('select[name="sub_subcategory_id"]').empty();
              $.each(data[0][0], function(key, value){
                if(data[0][1].sub_sub_category_id == value.id) {
                  $('select[name="sub_subcategory_id"]').append('<option value="'+ value.id + '" selected>' + value.name + '</option>');
                   }
                    else {
                      $('select[name="sub_subcategory_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');
                    }
    

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
          if (subcategory_id) {
            $.ajax({
              url: "{{ url('/get/subsubcategory') }}/"+subcategory_id  ,
              type:"GET",
              dataType:"json",
              success:function(data) { 
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
          if (subcategory_id) {
            $.ajax({
              url: "{{ url('/get/subsubcategory') }}/"+subcategory_id  ,
              type:"GET",
              dataType:"json",
              success:function(data) { 
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

@endsection