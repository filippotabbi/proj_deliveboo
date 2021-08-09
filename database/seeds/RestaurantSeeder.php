<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
use App\Category;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = config('restaurants');
        foreach ($restaurants as $i =>$restaurant) {
            $newRestaurant = new Restaurant();
            $newRestaurant->name = $restaurant['name'];
            $newRestaurant->address = $restaurant['address'];
            $newRestaurant->logo = $restaurant['logo'];
            $newRestaurant->description = $restaurant['description'];
            $newRestaurant->banner = $restaurant['banner'];
            $newRestaurant->slug = $this->generateSlug($restaurant['name']);
            $newRestaurant->user_id = rand(1,5);
            
            $newRestaurant->save();
            
            // $newRestaurant = Restaurant::find(1);
            // $newRestaurant->categories()->attach([1,2,3]);

           

        }
    }

    private function generateSlug(string $title) {

      $slug = Str::slug($title,'-');
      $slug_base = $slug;
      $contatore = 1;

      $post_with_slug = Restaurant::where('slug','=',$slug)->first();
      while($post_with_slug) {
        $slug = $slug_base . '-' . $contatore;
        $contatore++;

        $post_with_slug = Restaurant::where('slug','=',$slug)->first();
      }
      return $slug;
    }
}
