<?php

namespace App\Http\Controllers;

use App\ProductVariantOption;
use Illuminate\Http\Request;

class ProductVariantOptionController extends Controller
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
        $productVariantOption = new  ProductVariantOption();
        $productVariantOption->product_variant_id = $request->productVariant_id;
        $productVariantOption->name = $request->variant_name;
        $productVariantOption->save();
        return \redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductVariantOption  $productVariantOption
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVariantOption $productVariantOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductVariantOption  $productVariantOption
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVariantOption $productVariantOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductVariantOption  $productVariantOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVariantOption $productVariantOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductVariantOption  $productVariantOption
     * @return \Illuminate\Http\Response
     */
    public function delete(ProductVariantOption $productVariantOption)
    {
        $productVariantOption->delete();
        return \redirect()->back();
    }
}
