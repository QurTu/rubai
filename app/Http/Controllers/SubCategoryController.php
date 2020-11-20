<?php

namespace App\Http\Controllers;

use App\SubCategory;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategories = SubCategory::all();
        $categories = Category::all();
        return view('admin.subCategory.subCategory',  compact('categories', 'subCategories'));
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
        $subCategory = new SubCategory();
        $subCategory->name = $request->name;
        $subCategory->category_id  = $request->category_id;
        $subCategory->save();
        return redirect()->back()->with('success', ' succesfully added');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\SubKategory  $subKategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubKategory  $subKategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        {
            $categories = Category::all();
            return view('.admin.subCategory.edit' , compact('subCategory', 'categories'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubKategory  $subKategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        {
            $subCategory->name = $request->name;
            $subCategory->category_id = $request->category_id;
            $subCategory->save();
            return redirect()->route('subcategory');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubKategory  $subKategory
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $subSubCategory = SubCategory::where('id', $request->category_id)->first();
        $products = Product::where('sub_sub_category_id', $subSubCategory->id)->get();
        return $products;
        $subCategory->delete();
        return redirect()->route('subcategory');
    }
}