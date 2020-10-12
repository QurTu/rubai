<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\subCategory;

class Category extends Model
{
    public function categoryAllSub()
    {
        return $this->hasMany('App\SubCategory', 'category_id', 'id'); //KOLEKCIJA
    }
    public function Products()
    {
        return $this->hasMany('App\Product', 'category_id', 'id'); //KOLEKCIJA
    }
}
