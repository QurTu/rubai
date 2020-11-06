<?php

namespace App\Http\Controllers;
use Cart;
use App\Product;
use Auth;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($id){

        
        $product = Product::where('id',$id)->first();

        $data = array();
           $data['id'] = $product->id;
           $data['name'] = $product->name;
           $data['qty'] = 1;
           $data['price'] = $product->price;
           $data['weight'] = 1;
           $data['options']['image'] = $product->image;
           $data['options']['color'] = '';
           $data['options']['size'] = '';

            Cart::instance('cart')->add($data);
            Cart::instance('cart')->merge(Auth::id());
             Cart::instance('cart')->erase( Auth::id());
             Cart::instance('cart')->store( Auth::id());
            return \Response::json(['success' => 'Successfully Added on your Cart']);
    }


    public function addFromProduct(Request $request){
        $data = array();
           $data['id'] = $request->product_id;
           $data['name'] = $request->product_name;
           $data['qty'] = $request->product_qnt;
           $data['price'] = $request->product_price;
           $data['weight'] = 1;
           $data['options']['image'] = $request->product_image;
           if(isset($request->variant)) {
           foreach( $request->variant as $key => $value) {
            $data['options'][$key] = $value;
           }
          }
            Cart::destroy();
            Cart::instance('cart')->add($data);
            Cart::instance('cart')->merge(Auth::id());
             Cart::erase( Auth::id());   
             Cart::instance('cart')->store( Auth::id());        
             $notification=array(
                'messege'=>'Successfully Added on your Cart!',
                'alert-type'=>'success'
                 );
               return Redirect()->back()->with($notification);

    }

    public function remove(Request $request){
      Cart::instance('cart')->remove($request->rowId);
      Cart::erase( Auth::id());
      Cart::instance('cart')->store( Auth::id()); 
      return \redirect()->back();
    }
}
