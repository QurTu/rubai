<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    
        {
            $produ = DB::table('products')
            ->join('categories', 'categories.id', '=' ,'products.category_id')
            ->join('sub_categories', 'sub_categories.id', '=' , 'products.sub_category_id')
            ->join('sub_sub_categories', 'sub_sub_categories.id',  '=' ,'products.sub_sub_category_id')
            ->select('products.*', 'categories.name as category_name' , 'sub_categories.name as sub_category_name','sub_sub_categories.name as sub_sub_category_name')
            ->get();
            $products= json_decode( json_encode($produ), true);
          
            $categories = Category::all();
            return view('admin.product.product',  compact('categories', 'products') ); 
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
      
        $product = new Product();
        $product->name = $request->name;
        $product->discription = $request->decreption;
        $product->status = 1;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->subcategory_id;
        $product->sub_sub_category_id = $request->sub_subcategory_id;

        
        if ($request->hasFile('image')) {
            $ext =  $request->file('image')->getClientOriginalName();
            $image_name = date('dmy_H_s_i');
            $image_full_name = $image_name . '.' .$ext;
            $uplode_path = public_path("images\\");
            $image_url =$uplode_path . $image_full_name;
              $request->image->move($uplode_path, $image_full_name);
            $product->image = $image_full_name;
        }
        $product->save();
        $notification=array(
            'messege'=>'Old Password matched!',
            'alert-type'=>'success'
             );
        return redirect()->back()->with($notification);
      
        
        


        

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
