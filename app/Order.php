<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    public function OrderDetails()
    {
        return $this->hasMany('App\Order_detail', 'order_id', 'id'); //KOLEKCIJA
    }
}
