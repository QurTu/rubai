<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\SubCategory;
class SubSubCategory extends Model
{
    public function subSubCategoryBelongsCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function subSubCategoryBelongsSubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }
}
