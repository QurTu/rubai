<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('/admin', 'AdminController@index')->name('admin.home');
     // Category routes
     Route::get('admin/category', 'CategoryController@index')->name('category');
     Route::post('admin/category/add', 'CategoryController@add')->name('category.add');
     Route::post('admin/category/delete/{category}', 'CategoryController@delete')->name('category.delete');
     Route::get('admin/category/edit/{category}', 'CategoryController@edit')->name('category.edit');
     Route::post('admin/category/update/{category}', 'CategoryController@update')->name('category.update');
     //sub-category routs
     Route::get('admin/sub/category', 'SubCategoryController@index')->name('subcategory');
     Route::post('admin/sub/category/add', 'SubCategoryController@add')->name('subcategory.add');
     Route::post('admin/sub/category/delete/{subCategory}', 'SubCategoryController@delete')->name('subcategory.delete');
     Route::get('admin/sub/category/edit/{subCategory}', 'SubCategoryController@edit')->name('subcategory.edit');
     Route::post('admin/sub/category/update/{subCategory}', 'SubCategoryController@update')->name('subcategory.update');
     //sub-sub-category routs
     Route::get('admin/sub/subcategory', 'SubSubCategoryController@index')->name('subsubcategory');
     Route::post('admin/sub/subcategory/add', 'SubSubCategoryController@add')->name('subsubcategory.add');
     Route::post('admin/sub/subcategory/delete/{subSubCategory}', 'SubSubCategoryController@delete')->name('subsubcategory.delete');
     Route::get('admin/sub/subcategory/edit/{subSubCategory}', 'SubSubCategoryController@edit')->name('subsubcategory.edit');
     Route::post('admin/sub/subcategory/update/{subSubCategory}', 'SubSubCategoryController@update')->name('subsubcategory.update');

     //ajax get sub-category
     Route::get('get/subcategory/{id}', 'SubSubCategoryController@getSubCategoryNew')->name('get.subcategoryNew');
     Route::get('get/subcategory/{id}/{name}', 'SubSubCategoryController@getSubCategory')->name('get.subcategory');
     Route::get('get/subcategory/product/{id}/{name}', 'SubSubCategoryController@getSubCategoryP')->name('get.subcategory.product');
     Route::get('get/subsubcategory/product/{id}/{name}', 'SubSubCategoryController@getSubSubCategory')->name('get.subsubcategory.product');

    //ajax get sub-sub-category
     Route::get('get/subsubcategory/{id}', 'SubSubCategoryController@getSubSubCategoryNew')->name('get.subsubcategoryNew');
    // product routes
    Route::get('admin/product', 'ProductController@index')->name('product');
    Route::post('admin/product/add', 'ProductController@add')->name('product.add');
    Route::post('admin/product/delete/{product}', 'ProductController@delete')->name('product.delete');
    Route::get('admin/product/edit/{product}', 'ProductController@edit')->name('product.edit');
    Route::post('admin/product/update/{product}', 'ProductController@update')->name('product.update');
    // variant routes
    Route::get('admin/variant', 'VariantController@index')->name('variant');
    Route::post('admin/variant/add', 'VariantController@add')->name('variant.add');
    Route::post('admin/variant/delete/{variant}', 'VariantController@delete')->name('variant.delete');
    Route::get('admin/variant/edit/{variant}', 'VariantController@edit')->name('variant.edit');
    Route::post('admin/variant/update/{variant}', 'VariantController@update')->name('variant.update');
    //variant_options toutes
    Route::get('admin/variant/options', 'VariantOptionController@index')->name('variant.options');
    Route::post('admin/variant/options/add', 'VariantOptionController@add')->name('variant.options.add');
    Route::post('admin/variant/options/delete/{variant}', 'VariantOptionController@delete')->name('variant.options.delete');
    Route::get('admin/variant/options/edit/{variant}', 'VariantOptionController@edit')->name('variant.options.edit');
    Route::post('admin/variant/options/update/{variant}', 'VariantOptionController@update')->name('variant.options.update');

     
     