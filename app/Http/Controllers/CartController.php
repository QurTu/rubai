<?php

namespace App\Http\Controllers;
use Cart;
use App\Product;

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
            Cart::instance('shopping')->add($data);
            return \Response::json(['success' => 'Successfully Added on your Cart']);
    }
}
