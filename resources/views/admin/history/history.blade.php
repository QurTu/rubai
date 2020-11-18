@extends('admin.layout')
    
@section('content')
     <!--    content  SECTION -->
     <div  style="background-color: white;" class="container collar"> 
            <div class="day">
                <form action="{{route('orders.history')}}"   method="get">
                <div class="historypicker" >
                  <h2>HISTORY</h2> 
                <div class="historypickercommet">Choose range you want to search:</div>
  <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
 
      <i class="fa fa-calendar"></i>&nbsp;
      <span name='dates'></span> <i class="fa fa-caret-down"></i>
      <input type="hidden" name="start">
      <input type="hidden" name="end">
  </div>
              <button type="submit" class="btn btn-success">Get History</button>
                 </form>
                </div> 
              </div>
              </div>




              <div class="sl-mainpanel">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Order_id</th>
      <th scope="col">status</th>
      <th scope="col">actions</th>
     
    </tr>
  </thead>
  <tbody>
  @foreach($histories as $history)
    <tr>
      <td scope="row">{{$history->id}}</td>
      <td scope="row">{{$history->status}}</td>
      <td>{{$history->date}}
     
      
      </td>
    </tr>
    @endforeach
    
  </tbody>
</table>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
        $(function() {        
            var start = moment().subtract(29, 'days');
            var end = moment();       
            function cb(start, end) {
                $('#reportrange span').html(start.format('D MMMM , YYYY ') + ' - ' + end.format('D MMMM , YYYY'));
                $("input[name='start']").val(start.format('YYYY-MM-DD')) ;
                $("input[name='end']").val(end.format('YYYY-MM-DD')) ;
            }        
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                   'This Month': [moment().startOf('month'), moment().endOf('month')],
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);        
            cb(start, end);       
        });  
        </script>
@endsection