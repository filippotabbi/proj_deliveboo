<?php

namespace App\Http\Controllers\Api;

use App\Restaurant;
use App\Category;
use app\Dish;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::with('categories')->get();

        return response()->json([
            'response' => $restaurants,
            'success' => true,
        ]);
    }

    public function filterRestaurants(string $categoryId)
    {
        // $categoryIdsArray =  explode(",", $categoryIds);
        // foreach ($categoryIdsArray as $categoryId) {
        //     $category = Category::where('id', $categoryId)->first();
        //     $restaurantsFromCategory = $category->restaurants()->get();
        //     foreach ($restaurantsFromCategory as $restaurantFromCategory) {
        //         $filteredRestaurantsComplete[] = $restaurantFromCategory;
        //     }
        // }
        // $filteredRestaurantsUnique = array_unique($filteredRestaurantsComplete);
        $category = Category::where('id', $categoryId)->first();

        $filteredRestaurants = $category->restaurants()->with('categories')->get();

        return response()->json([
            'response' => $filteredRestaurants,
            'success' => true,
        ]);
    }

    public function searchRestaurant(string $query)
    {
        $restaurants = Restaurant::where('name', 'LIKE', '%' . $query . '%')->with('categories')->get();

        return response()->json([
            'response' => $restaurants,
            'success' => true,
        ]);
    }
}
