<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
      'customer_name',
      'customer_lastname',
      'customer_adress',
      'customer_phone_number',
      'customer_email',
      'total_price',
      'order_details'
  ];

  public function restaurant()
  {
    return $this->belongsTo('App\Restaurant');
  }

  public function dishes(){
    return $this->belongsToMany('App\Dish', 'dish_order')->withPivot('quantity');
  }
}
