<?php

namespace App\Http\Controllers;

use App\UniqueProduct;
use Illuminate\Http\Request;

class UniqueProductController extends Controller
{
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
       
        $uniqeProduct = new UniqueProduct();
        $uniqeProduct->product_id = $request->product_id;
        $uniqeProduct->variants = json_encode($request->variants);
        $uniqeProduct->qnt = $request->qnt;
        $uniqeProduct->save();

        return \redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UniqueProduct  $uniqueProduct
     * @return \Illuminate\Http\Response
     */
    public function show(UniqueProduct $uniqueProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UniqueProduct  $uniqueProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(UniqueProduct $uniqueProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UniqueProduct  $uniqueProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UniqueProduct $uniqueProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UniqueProduct  $uniqueProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(UniqueProduct $uniqueProduct)
    {
        //
    }
}
