<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubSubCategory;
use App\SubCategory;
use App\Category;

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
        return view('layouts.frontend', \compact('categories','subCategories', 'subSubCategories' ));
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
        $subSubCategories = SubSubCategory::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
        return view('front-end.cart', \compact('categories','subCategories', 'subSubCategories' ));
    }
    public function shop()
    {
        $subSubCategories = SubSubCategory::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
        return view('front-end.shop', \compact('categories','subCategories', 'subSubCategories' ));
    }
    public function contact()
    {
        $subSubCategories = SubSubCategory::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
        return view('front-end.contact', \compact('categories','subCategories', 'subSubCategories' ));
    }



}


