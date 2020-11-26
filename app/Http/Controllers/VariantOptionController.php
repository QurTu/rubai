<?php

namespace App\Http\Controllers;

use App\VariantOption;
use Illuminate\Http\Request;

class VariantOptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $variantOption = new VariantOption();
        $variantOption->name = $request->name;
        $variantOption->variant_id = $request->variant_id;
        $variantOption->save();

        $notification=array(
            'messege'=>'Old Password matched!',
            'alert-type'=>'success'
             );
        return redirect()->back()->with($notification);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\VariantOption  $variantOption
     * @return \Illuminate\Http\Response
     */
    public function show(VariantOption $variantOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VariantOption  $variantOption
     * @return \Illuminate\Http\Response
     */
    public function edit(VariantOption $variantOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VariantOption  $variantOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VariantOption $variantOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VariantOption  $variantOption
     * @return \Illuminate\Http\Response
     */
    public function delete(VariantOption $variantOption)
    {
        $variantOption->delete();
        return redirect()->back();
    }
}
