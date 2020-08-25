<?php

namespace App\Http\Controllers;

use App\SubSubCategory;
use App\SubCategory;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        {   
            $subSubCategories = SubSubCategory::all();
            $categories = Category::all();
            return view('admin.subSubCategory.subCategory',  compact('categories',  'subSubCategories'));
        }

    public function getSubCategory($id, $name) {
        $data[0] = DB::table('sub_categories')->where('category_id', $id)->get();
        $data[1] = DB::table('sub_sub_categories')->where('name', $name)->first();

        return \Response::json([$data]);
        
       

    }
    public function getSubCategoryNew($id) {
        $data[0] = DB::table('sub_categories')->where('category_id', $id)->get();
        return \Response::json([$data]);
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
        $subsubCategory = new SubSubCategory();
        $subsubCategory->name = $request->name;
        $subsubCategory->category_id = $request->category_id;
        $subsubCategory->sub_category_id = $request->subcategory_id;
        $subsubCategory->save();
        return redirect()->back()->with('success', ' succesfully added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubSubCategory  $subSubCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubSubCategory $subSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubSubCategory  $subSubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubSubCategory $subSubCategory)
    
        
            {
                $categories = Category::all();
                $subcategories = SubCategory::all();
                return view('.admin.subSubCategory.edit' , compact('subSubCategory', 'categories', 'subcategories'));
            }
        
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubSubCategory  $subSubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubSubCategory $subSubCategory)
    {
        $subSubCategory->name = $request->name;
        $subSubCategory->category_id = $request->category_id;
        $subSubCategory->sub_category_id = $request->subcategory_id;
        $subSubCategory->save();
        return redirect()->route('subsubcategory');
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubSubCategory  $subSubCategory
     * @return \Illuminate\Http\Response
     */
    public function delete(SubSubCategory $subSubCategory)
    {
        $subSubCategory->delete();
        return redirect()->route('subsubcategory');
    }



}
