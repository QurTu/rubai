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
      <th scope="col">category</th>
      <th scope="col">actions</th>
     
    </tr>
  </thead>
  <tbody>
  <form action="{{route('subcategory.update',  [$subCategory])}}" method='post'>
  @csrf  
    <tr>
      <th scope="row"> <input type="text" name="name" value='{{$subCategory->name}}'></th>
     <th>  
       
        <label >  Kagegorija  </label>
        <select name="category_id" >
        @foreach ($categories as $category)
            <option value="{{$category->id}}"  @if($category->id == $subCategory->category_id ) selected @endif >{{$category->name}} </option>
        @endforeach
        </select> 
       
      </div>
      <div class="modal-footer">
       
        </th>

      
      <td>
      @csrf
      <button type="submit">Change name</button>
      
      </td>
    </tr>
    </form>
   