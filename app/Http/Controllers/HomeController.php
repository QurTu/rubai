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
use App\Libs\WebToPay;
class HomeController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   public function moketi(){
    try {             
     $request =  WebToPay::redirectToPayment(array(
            'projectid'     => 191183,
            'sign_password' => 'dc1c347d471f68e41ad2a9a1145941d6',
            'orderid'       => 3,
            'amount'        => 1000,
            'currency'      => 'EUR',
            'country'       => 'LT',
            'accepturl'     => route('accept'),
            'cancelurl'     => route('cancel'),
            'callbackurl'   => route('callback'),
            'test'          => 1,
        ));
       return redirect($request);
    } catch (WebToPayException $e) {
        // handle exception
    }
   }
   public function accept() {
       echo 'bybys1';

   }
   public function cancel() {
    echo 'bybys2';

}
public function callback() {
    echo 'bybys3';

}


   public function PaymentAccept() {

    try{
        $response = WebToPay::checkResponse($_GET, array(
            'projectid' => 191183,
            'sign_password' => 'dc1c347d471f68e41ad2a9a1145941d6',
        ));
     
        if($response['test'] !== '0'){
            throw new Exception('Testing, real payment was not made');
        }
        if($response['type'] !== 'macro'){
            throw new Exception('Only macro payment callbacks are accepted');
        }
     
        $orderId = $response['orderid'];
        $amount = $response['amount'];
        $currency = $response['currency'];
        //@todo: patikrinti, ar užsakymas su $orderId dar nepatvirtintas (callback gali būti pakartotas kelis kartus)
        //@todo: patikrinti, ar užsakymo suma ir valiuta atitinka $amount ir $currency
        //@todo: patvirtinti užsakymą

        // rasti avo duombazeje orderi ir jam pakeisti statusa i amoketa, kai padrai patikirinimus.
     
       
    } catch(Exception$e) {
        echo get_class($e) . ':' . $e->getMessage();

   }
}

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


