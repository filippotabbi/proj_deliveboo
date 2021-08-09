<?php

use Illuminate\Database\Seeder;
use App\Dish;
use Illuminate\Support\Str;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes = config('dishes');
        foreach ($dishes as $dish) {
            $newDish = new Dish();
            $newDish->name = $dish['name'];
            $newDish->description = $dish['description'];
            $newDish->price = $dish['price'];
            $newDish->available = $dish['available'];
            $newDish->image = $dish['image'];
            $newDish->slug = $this->generateSlug($dish['name']);
            $newDish->restaurant_id = $dish['restaurant_id'];
            $newDish->save();
        }
    }

    private function generateSlug(string $title) {

      $slug = Str::slug($title,'-');
      $slug_base = $slug;
      $contatore = 1;

      $post_with_slug = Dish::where('slug','=',$slug)->first();
      while($post_with_slug) {
        $slug = $slug_base . '-' . $contatore;
        $contatore++;

        $post_with_slug = Dish::where('slug','=',$slug)->first();
      }
      return $slug;
    }
}
