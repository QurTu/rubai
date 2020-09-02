<?php

namespace App\Http\Controllers;

use App\Variant;
use App\VariantOption;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $variants = Variant::all();
        return view('admin.variant.variant',  ['variants' => $variants]);
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
        $variant = new Variant();
        $variant->name = $request->name;
        $variant->save();

        $notification=array(
            'messege'=>'Old Password matched!',
            'alert-type'=>'success'
             );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function show(Variant $variant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function edit(Variant $variant)
    { 
        $variantOptions =  VariantOption::where('variant_id', $variant->id)->get();
        return view('.admin.variant.edit' , compact('variant', 'variantOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variant $variant)
    {
        $variant->name = $request->name;
        $variant->save();

        $notification=array(
            'messege'=>'Old Password matched!',
            'alert-type'=>'success'
             );
           return Redirect()->route('variant')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function delete(Variant $variant)
    {
        $variant->delete();
        return redirect()->route('variant');
    }
    
}
