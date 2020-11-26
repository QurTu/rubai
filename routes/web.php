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



Auth::routes();
// ajex add to cart + add to wish list
Route::get('/cartAdd/{id}', 'CartController@add')->name('add.cart');
Route::post('/cart/remove', 'CartController@remove')->name('remove.cart');
Route::post('add/to/cart/product', 'CartController@addFromProduct')->name('Cart.from.product');


Route::get('/wishListAdd/{id}', 'WishListController@add')->name('add.wishlist');

// shop front-end
Route::get('/', 'HomeController@index')->name('home');


Route::get('/product/{id}', 'HomeController@product')->name('product.list');
Route::get('/product/select/variants/{input}/{id}/{name}', 'HomeController@productAjax')->name('product.input');

Route::post('/moket', 'HomeController@moketi')->name('moketi');
Route::get('/moket/acc', 'HomeController@accept')->name('accept');
Route::get('/moket/got', 'HomeController@cancel')->name('cancel');
Route::post('/moket/callback', 'HomeController@PaymentAccept')->name('callback');

Route::get('/cart', 'HomeController@cart')->name('cart');
Route::get('/wishlist', 'HomeController@wishlist')->name('wishlist');

Route::get('/contact', 'HomeController@contact')->name('contact');


//search
Route::get('/shop', 'HomeController@shop')->name('shop');
Route::get('/shop/search', 'HomeController@search')->name('search');
Route::get('/shop/category/{id}', 'HomeController@searchCat')->name('search.category');
Route::get('/shop/subcategory/{id}', 'HomeController@searchSubCat')->name('search.subcategory');
Route::get('/shop/subsubcategory/{id}', 'HomeController@searchSubSubCat')->name('search.subsubcategory');

//shipping
Route::get('/shipping', 'ShippingController@shipping')->name('shipping');
Route::post('/shipping/add', 'ShippingController@add')->name('shipping.add');
Route::post('/shipping/fromList', 'ShippingController@fromList')->name('shipping.fromList');
//Route::get('/shipping/edit/{shipping}', 'ShippingController@edit')->name('shipping.edit');
//Route::post('/shipping/update/{shipping}', 'ShippingController@update')->name('shipping.update');
//Route::post('/shipping/delete/{shipping}', 'ShippingController@delete')->name('shipping.delete');

//ORDER
Route::get('/order', 'HomeController@order')->name('order');








                                    //  admin routes
Route::get('/admin', 'AdminController@index')->name('admin.home');
     // Category routes
     Route::get('admin/category', 'CategoryController@index')->name('category');
     Route::post('admin/category/add', 'CategoryController@add')->name('category.add');
     Route::post('admin/category/delete', 'CategoryController@delete')->name('category.delete');
     Route::get('admin/category/edit/{category}', 'CategoryController@edit')->name('category.edit');
     Route::post('admin/category/update/{category}', 'CategoryController@update')->name('category.update');
     //sub-category routs
     Route::get('admin/sub/category', 'SubCategoryController@index')->name('subcategory');
     Route::post('admin/sub/category/add', 'SubCategoryController@add')->name('subcategory.add');
     Route::post('admin/sub/category/delete', 'SubCategoryController@delete')->name('subcategory.delete');
     Route::get('admin/sub/category/edit/{subCategory}', 'SubCategoryController@edit')->name('subcategory.edit');
     Route::post('admin/sub/category/update/{subCategory}', 'SubCategoryController@update')->name('subcategory.update');
     //sub-sub-category routs
     Route::get('admin/sub/subcategory', 'SubSubCategoryController@index')->name('subsubcategory');
     Route::post('admin/sub/subcategory/add', 'SubSubCategoryController@add')->name('subsubcategory.add');
     Route::post('admin/sub/subcategory/delete', 'SubSubCategoryController@delete')->name('subsubcategory.delete');
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
    Route::post('admin/variant/options/delete/{variantOption}', 'VariantOptionController@delete')->name('variant.options.delete');
    Route::get('admin/variant/options/edit/{variantOption}', 'VariantOptionController@edit')->name('variant.options.edit');
    Route::post('admin/variant/options/update/{variantOption}', 'VariantOptionController@update')->name('variant.options.update');

    // variantOption routes
    Route::post('admin/productVariant/add', 'ProductVariantController@add')->name('productVariant.store');
    Route::post('admin/productVariant/delete/{productVariant}', 'ProductVariantController@delete')->name('productVariant.delete');
    Route::get('admin/productVariant/edit/{productVariant}', 'ProductVariantController@edit')->name('productVariant.edit');
    
    // ProductVariantOption routes
    Route::post('admin/ProductVariantOption/add', 'ProductVariantOptionController@add')->name('productVariantOption.store');
    Route::post('admin/ProductVariantOption/delete/{productVariantOption}', 'ProductVariantOptionController@delete')->name('productVariantOption.delete');
    //unique product
    Route::post('admin/uniqueProduct/add', 'UniqueProductController@add')->name('uniqueProduct.store');

    // oreder routes 
   
    
    Route::get('admin/orders', 'OrderController@allOrders')->name('orders.all');
    Route::get('admin/orders/unpaid', 'OrderController@unPaidOrders')->name('orders.unpaid');
    Route::get('admin/orders/paid', 'OrderController@paidOrders')->name('orders.paid');
    Route::get('admin/orders/ready', 'OrderController@readyOrders')->name('orders.readyGet');
    Route::get('admin/orders/done', 'OrderController@doneOrders')->name('orders.done');
    Route::post('admin/orders/ready/{order}', 'OrderController@ready')->name('orders.ready');
    Route::get('admin/orders/pickHistrory', 'OrderController@pickHistrory')->name('orders.pickHistrory');
    Route::get('admin/orders/histrory', 'OrderController@history')->name('orders.history');
    Route::get('admin/orders/edit/{order}', 'OrderController@allOrdersEdit')->name('orders.edit');

    //mail
    Route::get('admin/mail/unread', 'MailController@unReadMail')->name('mail.unread');
    Route::get('admin/mail/all', 'MailController@allMail')->name('mail.all');
    Route::get('admin/mail/message/{mail}', 'MailController@message')->name('mail.details');
    Route::post('mail/create', 'HomeController@sendMail')->name('mail.create');
    Route::post('admin/mail/message/changeStatus/{mail}', 'MailController@changeStatus')->name('mail.response');
   