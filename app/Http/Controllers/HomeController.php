<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubSubCategory;
use App\SubCategory;
use App\Category;
use App\Product;
use App\Shipping;
use App\Order;
use App\Mail;
use App\Order_detail;
use Cart;
use Illuminate\Support\Facades\DB;
use App\ProductVariant;
use App\ProductVariantOption;
use App\UniqueProduct;
use Auth;
use Session;
use App\Libs\WebToPay;
use RecentlyViewed\Models\Contracts\Viewable;
class HomeController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   public function moketi(){
       
      
    $cart = Cart::instance('cart')->content();
    $shipping = Shipping::where('user_id', Auth::id())->first();
    $order = new Order();
    $order->payment = 'paysera';
    $order->how_ship = 'kurjeris';
    // price work
     $price =str_replace(",", "",Cart::instance('cart')->subtotal());
     $price = floatval ( $price) ;
    $order->price =  $price;
    $order->status = 1;
    $order->user_id = Auth::id();
    $order->shipping_id = $shipping->id;
    $order->save();
    foreach($cart as $item){
        $details = new Order_detail();
        $details->order_id = $order->id;
        $details->product_id = $item->id;
        $details->qnt = $item->qty;
        $variants =array();
        foreach($item->options as $key => $variant) {
            if($key != 'image') {
                $variants[$key] = $variant;
            }
        }
        $details->variants = json_encode($variants);
        $details->save();
    }
    Cart::destroy();
    Cart::instance('cart')->erase( Auth::id());


    try {             
     $request =  WebToPay::redirectToPayment(array(
            'projectid'     => 191183,
            'sign_password' => 'dc1c347d471f68e41ad2a9a1145941d6',
            'orderid'       => $order->id,
            'amount'        => $order->price * 100,
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
       $this->PaymentAccept(); // callback  remove in real website
       Session::put('payment', 1);
      return redirect(route('home'));

   }
   public function cancel() {
    Session::put('payment', 0);
    return redirect(route('home'));

}



   public function PaymentAccept() {

    try{
        $response = WebToPay::checkResponse($_GET, array(
            'projectid' => 191183,
            'sign_password' => 'dc1c347d471f68e41ad2a9a1145941d6',
        ));
     
     
        $orderId = $response['orderid'];
        $amount = $response['amount'];
        $currency = $response['currency'];
        $order = Order::where('id' , $orderId )->first();
        if($order->status == 1 && $amount == $order->price *  100  &&  $currency == "EUR" ) {
            $order->status = 2;
            $order->save();
        }
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
    public function index(Request $request)
    {
            
        $categoriesWithProducts = Category::all()->take(2);
        foreach($categoriesWithProducts as $categorie) {
          $categorie =  $categorie->products;
        }
        $payment = 10;
        if(Session::has('payment')) {
            $payment = Session::get('payment');
            $request->session()->forget('payment');
          }  
        return view('front-end.home', \compact( 'categoriesWithProducts', 'payment'));
    }


    public function product($id , Request $request)
    {
        //product info
        $product = Product::where('id', $id)->first();
      //  \RecentlyViewed\Facades\RecentlyViewed::add($product);
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
       
        

       

        return view('front-end.product', \compact( 'products', 'productVariant' ));
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
      // return $cart;
        return view('front-end.cart', \compact( 'cart' ));
    }   
    public function wishlist()
    {   
        $cart = Cart::instance('wishlist')->content();  
        return view('front-end.wishlist', \compact( 'cart' ));
    }


    public function contact()
    {
        return view('front-end.contact');
    }
                                           
                                     // Shop Pages 
     public function shop()
    {    
        $products = Product::paginate(24);
       $priceMin = $products->min('price');
       $priceMax =  $products->max('price');
        return view('front-end.shop', \compact( 'products','priceMin', 'priceMax'  ));
    }                                         
    public function searchCat($id) {
        $subCats = SubCategory::where('category_id' , $id)->get();
        $products = Product::where('category_id', $id)->paginate(24);
        $priceMin = $products->min('price');
        $priceMax =  $products->max('price');
        return view('front-end.shop', \compact( 'products', 'subCats', 'priceMin', 'priceMax' ));
    }
    public function searchSubCat($id) {  
        $subCats = SubSubCategory::where('sub_category_id' , $id)->get();   
        $products = Product::where('sub_category_id', $id)->paginate(24);
        $priceMin = $products->min('price');
        $priceMax =  $products->max('price');
        return view('front-end.shop', \compact( 'products', 'subCats' , 'priceMin', 'priceMax'));
    }
    public function searchSubSubCat($id) {
        $subCats = SubSubCategory::where('sub_category_id' , $id)->get();
        $products = Product::where('sub_sub_category_id', $id)->paginate(24);
        $priceMin = $products->min('price');
        $priceMax =  $products->max('price');
        return view('front-end.shop', \compact( 'products', 'subCats', 'priceMin', 'priceMax' ));
    }
    public function search(Request $request){
        
        $products = Product::where('name', 'like', "%$request->search%")->paginate(24);
        $priceMin = $products->min('price');
        $priceMax =  $products->max('price');
        $subCats = Category::all();
         return view('front-end.shop', \compact( 'products', 'subCats', 'priceMin', 'priceMax' ));
    }
              // mail add
              
    public function sendMail(Request $request) {
        $mail = new Mail();
        $mail->name = $request->name;
        $mail->email =$request->email;
        $mail->phoneNumber =$request->phoneNumber;
        $mail->message = $request->message;
        $mail->save();
        return \redirect()->back();
    }
    
    public static function order() {

      Cart::instance('cart')->count();   
        if(Cart::instance('cart')->count()   == 0) {
            return redirect(route('cart'));
        }
        if(Session::has('shipping')) {
          $shipping = Session::get('shipping');
        return view("front-end.order", compact('shipping'));  
        }else {
            return redirect(route('shipping'));
        }


        
    }

}


