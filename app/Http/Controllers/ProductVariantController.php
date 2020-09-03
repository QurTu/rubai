<?php

namespace App\Http\Controllers;

use App\ProductVariant;
use App\VariantOption;
use App\ProductVariantOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductVariantController extends Controller
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
        
        $productVariant = new ProductVariant();
        $productVariant->product_id = $request->product_id;
        $productVariant->variant_id = $request->variant_id;
        $productVariant->save();
        return \redirect()->back();
    }

   

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVariant $productVariant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVariant $productVariant)
    {

        $productVar = DB::table('product_variants')
        ->join('products', 'products.id', '=' ,'product_variants.product_id')
        ->join('variants', 'variants.id', '=' , 'product_variants.variant_id')
        ->select('product_variants.*', 'variants.name as variant_name' , 'products.name as product_name')
        ->where('product_variants.id', $productVariant->id )
        ->get();
        $variantOptions = VariantOption::where('variant_id', $productVariant->variant_id )->get();
        $productVariantOptions = ProductVariantOption::where('product_variant_id', $productVariant->id)->get();
        return view('admin.product.variantOption' , compact('productVar', 'variantOptions' ,'productVariantOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVariant $productVariant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function delete(ProductVariant $productVariant)
    {
        $productVariant->delete();
        return redirect()->back();
    }
}
