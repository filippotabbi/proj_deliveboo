<?php

namespace App\Http\Controllers\Api;

use App\Restaurant;
use App\Dish;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($restaurantId)
    {
        $dishes = Dish::where('restaurant_id',$restaurantId)->where('available',1)->orderBy('name','asc')->get();

        return response()->json([
            'response' => $dishes,
            'success' => true,
        ]);
    }
}
