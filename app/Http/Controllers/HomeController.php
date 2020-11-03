<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubSubCategory;
use App\SubCategory;
use App\Category;
use App\Product;
use Cart;

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
       
        return view('layouts.frontend', \compact('categories','subCategories', 'subSubCategories', 'categoriesWithProducts' ));
    }


    public function product()
    {
        $subSubCategories = SubSubCategory::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
        return view('front-end.product', \compact('categories','subCategories', 'subSubCategories' ));
    }

    public function cart()
    {   
        $cart = Cart::instance('shopping')->content();
        $subSubCategories = SubSubCategory::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
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


