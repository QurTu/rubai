<?php

namespace App\Http\View\Composers;


use Illuminate\View\View;
use App\SubSubCategory;
use App\SubCategory;
use App\Category;
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
        $view->with(['categories'=>  Category::all(), 'subCategories' => SubCategory::all(), 'subSubCategories'=>SubSubCategory::all() ]);
        
    }
}