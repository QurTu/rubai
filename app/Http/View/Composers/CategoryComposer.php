<?php

namespace App\Http\View\Composers;


use Illuminate\View\View;
use App\SubSubCategory;
use App\SubCategory;
use App\Category;
use App\Product;
use Cart;
class CategoryComposer
{


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $view->with([
          //  'recentlyViewedProducts' => \RecentlyViewed\Facades\RecentlyViewed::get(Product::class),
             'categories'=>  Category::all(),
              'subCategories' => SubCategory::all(), 
              'subSubCategories'=>SubSubCategory::all(),
              'cart' => Cart::instance('cart')->content()  ]);
        
    }
}