<?php

namespace App\Http\Controllers;

use App\Order;
use App\Shipping;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allOrders()
    {   
        $orders = Order::all();
        return view('admin.order.all' , compact( 'orders'));
    }

    public function unPaidOrders()
    {   
        $orders = Order::where('status' , 1)->get();
        return view('admin.order.unpayed' , compact( 'orders'));
    }

    public function paidOrders()
    {   
        $orders = Order::where('status' , 2)->get();
        return view('admin.order.payed' , compact( 'orders'));
    }

    public function readyOrders()
    {   
        $orders = Order::where('status' , 3)->get();
        return view('admin.order.payed' , compact( 'orders'));
    }

    
    public function doneOrders()
    {   
        $orders = Order::where('status' , 4)->get();
        return view('admin.order.payed' , compact( 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allOrdersEdit(Order $order)
    { 
        $order->details = $order->OrderDetails()->get();
        $order->shipping = Shipping::where('id', $order->shipping_id)->first();
        return view('admin.order.allEdit' , compact( 'order'));
    }

    public function ready(Order $order){
        $order->status = 3;
        $order->save();
        return redirect()->route('orders.paid');
    }
   

    public function pickHistrory(){
        return view('admin.history.pickHistory');
    }

    public function history(Request $request){
        $start = $request->start;
        $end = $request->end;
       $histories = Order::whereBetween('date', [$start, $end])->get();
        return view('admin.history.history' , \compact('histories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
