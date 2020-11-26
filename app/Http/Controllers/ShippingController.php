<?php

namespace App\Http\Controllers;

use App\Shipping;
use Illuminate\Http\Request;
use App\SubSubCategory;
use App\SubCategory;
use App\Category;
use Auth;
use Session;

class ShippingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shipping()
    {
        $subSubCategories = SubSubCategory::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();

        $shipping = Shipping::where('user_id' , Auth::id() )->get();
            return view('front-end.buy.shippingDetails', compact('categories', 'subCategories', 'subSubCategories', 'shipping'));
        
    
      
    }

    public function noAccess(){
        return view('front-end.onlyAdmin');
    }
   


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $shipping = new Shipping();
        $shipping->name = $request->name;
        $shipping->user_id = Auth::id();
        $shipping->lastName = $request->lastName;
        $shipping->address = $request->address;
        $shipping->city = $request->city;
        $shipping->phoneNumber = $request->phone;
        $shipping->postKode = $request->zip;
        $shipping->email = $request->email;
        $shipping->save();
        
        Session::put('shipping', $shipping);
        return redirect()->route('order');


    }
    public function fromList(Request $request )
    {
        $shipping = Shipping::where('user_id' , Auth::id())->where('id', $request->shipping)->first();
        Session::put('shipping', $shipping);
        
        return redirect()->route('order');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping $shipping)
    {
        $subSubCategories = SubSubCategory::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
        return view('front-end.buy.shippingEdit', compact('categories', 'subCategories', 'subSubCategories', 'shipping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipping $shipping)
    {
        $shipping->name = $request->name;
        $shipping->user_id = Auth::id();
        $shipping->lastName = $request->lastName;
        $shipping->address = $request->address;
        $shipping->city = $request->city;
        $shipping->phoneNumber = $request->phone;
        $shipping->postKode = $request->zip;
        $shipping->email = $request->email;
        $shipping->save();
        
        return  redirect()->route('shipping');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function delete(Shipping $shipping)
    {
        $shipping->delete();
        return redirect()->back();
    }
}
