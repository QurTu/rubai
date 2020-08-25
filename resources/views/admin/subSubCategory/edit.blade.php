@extends('admin.layout')

@section('content')
<div class="sl-mainpanel">
   

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">category</th>
      <th scope="col">sub-category</th>
      <th scope="col">actions</th>
     
    </tr>
  </thead>
  <tbody>
  <form action="{{route('subsubcategory.update', [$subSubCategory])}}" method='post'>
  @csrf  
    <tr>
      <th scope="row"> <input type="text" name="name" value='{{$subSubCategory->name}}'></th>

      
        <th> 
        <label >  sub-Kagegorija  </label>
        <select name="subcategory_id" id='subcategory'>
        @foreach ($subcategories as $subcategory)
            <option value= '{{$subcategory->id}}'  >  </option>
        @endforeach
        </select> 
        </th>
     <th> 
        <label >  Kagegorija  </label>
        <select name="category_id" id='category'>
        @foreach ($categories as $category)
            <option value="{{$category->id}}"  @if($category->id == $subSubCategory->category_id ) selected @endif >{{$category->name}} </option>
        @endforeach
        </select> 
        </th>


      
      <td>
      @csrf
      <button type="submit">Change name</button>
      
      </td>
    </tr>
    </form>

    <script type="text/javascript">
      $(document).ready(function(){
        let category_id =  $('select[name="category_id"]').val();
        let name =  $('input[name="name"]').val();
        console.log(name);
        console.log(category_id);
          if (category_id) {
            $.ajax({
              url: "{{ url('/get/subcategory') }}/"+category_id + "/" + name,
              type:"GET",
              dataType:"json",
              success:function(data) { 
              var d =$('select[name="subcategory_id"]').empty();
              $.each(data[0][0], function(key, value){
                
                if(data[0][1].sub_category_id == value.id) {
                  console.log('suveikiu');
              $('select[name="subcategory_id"]').append('<option value="'+ value.id + '" selected>' + value.name + '</option>');
               }
                else {
                  $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');
                }
                });
              },
            });
          }else{
            alert('danger');
          }
     $('select[name="category_id"]').on('change',function(){
          let category_id = $(this).val();
          let name =  $('input[name="name"]').val();
          console.log(name);
          if (category_id) {
            $.ajax({
              url: "{{ url('/get/subcategory') }}/"+category_id + "/" + name,
              type:"GET",
              dataType:"json",
              success:function(data) { 
                console.log(data);
                console.log('suveikiu');
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