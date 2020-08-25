<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
class SubCategory extends Model
{
    public function subCategoryBelongs()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function subCategoryAllSubSub()
    {
        return $this->hasMany('App\SubSubCategory', 'sub_category_id', 'id'); //KOLEKCIJA
    }
}
