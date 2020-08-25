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
}
