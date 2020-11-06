<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubSubCategory;
use App\SubCategory;
use App\Category;
use App\Product;
use Cart;
use Illuminate\Support\Facades\DB;
use App\ProductVariant;
use App\ProductVariantOption;
use App\UniqueProduct;
use Auth;
class HomeController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subSubCategories = SubSubCategory::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
        $categoriesWithProducts = Category::all()->take(2);
        foreach($categoriesWithProducts as $categorie) {
          $categorie =  $categorie->products;
        }
       
        return view('front-end.home', \compact('categories','subCategories', 'subSubCategories', 'categoriesWithProducts' ));
    }


    public function product($id)
    {
        //product info
        $subSubCategories = SubSubCategory::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
        $products = DB::table('products')
        ->join('categories', 'categories.id', '=' ,'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=' ,'products.sub_category_id')
        ->join('sub_sub_categories', 'sub_sub_categories.id', '=' ,'products.sub_sub_category_id')
        ->select('products.*', 'categories.name as category_name', 'sub_categories.name as sub_category_name', 'sub_sub_categories.name as sub_sub_category_name' )
        ->where('products.id', $id)->get() ;

        //gets product variants
        $productVariant = DB::table('product_variants')
        ->join('variants', 'variants.id' , '=', 'product_variants.variant_id')
        ->select('product_variants.*', 'variants.name as variant_name')
        ->where('product_id' , $id)->get();
        $uniqeProducts =  UniqueProduct::where('product_id', $id)->get();
        foreach($productVariant as $variant){
            $options = ProductVariantOption::where('product_variant_id', $variant->id)->get();
            $optArray = array();
            foreach($options as $option){
                $opt['qnt'] = 0;
                $opt['name']= $option->name;
                foreach($uniqeProducts as $uniqe){                   
                 $string = preg_replace('/[^A-Za-z0-9\-,]/', '', $uniqe->variants);                   
                    $arr = explode(",", $string);                                        
                   if(   in_array ($option->name , $arr ) ) {
                        $opt['qnt'] += $uniqe->qnt;
                    }
                    }
                array_push( $optArray ,  $opt ) ;
            }
            $variant->options = $optArray;
        }
      
      //  return $productVariant;
        return view('front-end.product', \compact('categories','subCategories', 'subSubCategories', 'products', 'productVariant' ));
    }

    public function productAjax($input, $id, $name){


          //gets product variants ajex
          $productVariant = DB::table('product_variants')
          ->join('variants', 'variants.id' , '=', 'product_variants.variant_id')
          ->select('product_variants.*', 'variants.name as variant_name')
          ->where('product_id' , $id)->get();
          $uniqeProducts =  UniqueProduct::where('product_id', $id)->get();
          foreach($productVariant as $variant){
              $options = ProductVariantOption::where('product_variant_id', $variant->id)->get();
              $optArray = array();
              foreach($options as $option){
                  $opt['qnt'] = 0;
                  $opt['name']= $option->name;
                  foreach($uniqeProducts as $uniqe){                   
                   $string = preg_replace('/[^A-Za-z0-9\-,]/', '', $uniqe->variants);                   
                      $arr = explode(",", $string);   
                      if($name == $variant->variant_name) {
                             if(   in_array ($option->name , $arr ) ) {
                        $opt['qnt'] += $uniqe->qnt;
                    }
                      }else { 
                     if(   in_array($option->name , $arr ) && in_array($input , $arr ) ) {
                          $opt['qnt'] += $uniqe->qnt;
                      }}
                      }
                  array_push( $optArray ,  $opt ) ;
              }
              $variant->options = $optArray;
          }
          
          return $productVariant;
          return \Response::json($productVariant);
    }

    public function cart()
    {   
       

        
        $cart = Cart::instance('cart')->content();
        $subSubCategories = SubSubCategory::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
      // return $cart;
        return view('front-end.cart', \compact('categories','subCategories', 'subSubCategories', 'cart' ));
    }

    
    public function wishlist()
    {   
        $cart = Cart::instance('wishlist')->content();
        $subSubCategories = SubSubCategory::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
        return view('front-end.wishlist', \compact('categories','subCategories', 'subSubCategories', 'cart' ));
    }


    public function contact()
    {
        $subSubCategories = SubSubCategory::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
        return view('front-end.contact', \compact('categories','subCategories', 'subSubCategories' ));
    }
                                           
                                     // Shop Pages 
     public function shop()
    {
        $subSubCategories = SubSubCategory::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
        $products = Product::paginate(25);
        return view('front-end.shop', \compact('categories','subCategories', 'subSubCategories', 'products'  ));
    }
                                           
    public function searchCat($id) {
        $subSubCategories = SubSubCategory::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
        $subCats = SubCategory::where('id' , $id)->get();
        $products = Product::where('category_id', $id)->paginate(25);
        return view('front-end.shop', \compact('categories','subCategories', 'subSubCategories', 'products', 'subCats' ));
    }
    public function searchSubCat($id) {
        $subSubCategories = SubSubCategory::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
        $subCats = SubSubCategory::where('id' , $id)->get();
        $products = Product::where('sub_category_id', $id)->paginate(25);
        return view('front-end.shop', \compact('categories','subCategories', 'subSubCategories', 'products', 'subCats' ));
    }
    public function searchSubSubCat($id) {
        $subSubCategories = SubSubCategory::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
        $subCats = SubSubCategory::where('id' , $id)->get();
        $products = Product::where('sub_sub_category_id', $id)->paginate(25);
        return view('front-end.shop', \compact('categories','subCategories', 'subSubCategories', 'products', 'subCats' ));
    }
    

}


