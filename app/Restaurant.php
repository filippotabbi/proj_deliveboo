<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
  protected $fillable = [
      'name',
      'address',
      'logo',
      'description',
      'banner',
      'slug',
      'user_id'
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function categories()
  {
    return $this->belongsToMany('App\Category');
  }

  public function dishes(){
      return $this->hasMany('App\Dish');
  }

  public function orders(){
      return $this->hasMany('App\Order');
  }

}
