@extends('admin.layout')

@section('content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Prideti nauja savybes bum
</button>
      </nav>

 <div> Produkto pavadinimas: {{$productVar[0]->product_name}}  </div>
 <div> Savybes pavadinimas: {{$productVar[0]->variant_name}}  </div>
 
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col"> Name</th>
      <th scope="col">actions</th>
     
    </tr>
  </thead>
  <tbody>
  <form action="" method="post">
    <tr>
      <th scope="row">  </th>
      <td>
      @csrf
      <button type="submit">Change name</button>
      
      </td>
    </tr>
    </form>
   
    
  </tbody>
</table>
</div>
</div>

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
      <div class="form-group"> 
          <form action="{{route('productVariant.store')}}" method='post'>  
          @csrf   
      <input type="hidden" name="product_id" value="">
            <label >  Savybe  </label> 
           <select name="variant_id" >
               @foreach ($variantOptions as $variantOption)
                  <option value="{{$variantOption->id}}">{{$variantOption->name}} </option>
                @endforeach
          </select> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">prideti</button>
        </form>
      </div>
          </div>
     
    </div>
  </div>
</div>



@endsectio