<?php

namespace App\Http\Controllers\Admin;

use App\Restaurant;
use App\Category;
use App\User;
use App\Dish;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
        $restaurants = Restaurant::where('user_id', Auth::user()->id)->get();

        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.restaurants.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string|max:100',
            'logo' => 'nullable|image|max:5000',
            'description' => 'required|string',
            'banner' => 'nullable|image|max:10000',
            'category_ids' => 'exists:categories,id|nullable',
        ]);
        $data = $request->all();

        //salvataggio immagini in storage
        $logo = NULL;
        if (array_key_exists('logo', $data)) {
            $logo = Storage::put('uploads', $data['logo']);
        }
        $banner = NULL;
        if (array_key_exists('banner', $data)) {
            $banner = Storage::put('uploads', $data['banner']);
        }

        // dd($request);

        //creo un novo ristorante e lo fillo
        $restaurant = new Restaurant();
        $restaurant->fill($data);

        //inserisco lo user id cercando lo user con cui si e' fatto l'accesso
        $restaurant->user_id = Auth::user()->id;
        //popolo lo slug con una funzione che si riferisce al restaurant name
        $restaurant->slug = $this->generateSlug($restaurant->name);

        //link immagini
        $restaurant->logo = 'storage/' . $logo;
        $restaurant->banner = 'storage/' . $banner;

        $restaurant->save();

        //popolare la tabella pvot
        if (array_key_exists('category_ids', $data)) {
            $restaurant->categories()->attach($data['category_ids']);
        }

        return redirect()->route('admin.restaurants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();

        //prendo il ristorante id
        $restaurant_id = $restaurant['id'];

        //uso il ristorante id per prendere i piatti relativi a quel ristorante
        $dishes = Dish::where('restaurant_id', $restaurant_id)->orderBy('name', 'asc')->get();

        if (Auth::user()->id != $restaurant['user_id']) {
            return redirect()->route('admin.restaurants.index');
        }

        return view('admin.restaurants.show', compact('restaurant', 'dishes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $categories = Category::all();
        $restaurant = Restaurant::where('slug', $slug)->first();

        if (Auth::user()->id != $restaurant['user_id']) {
            return redirect()->route('admin.restaurants.index');
        }

        return view('admin.restaurants.edit', compact('restaurant', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string|max:100',
            'logo' => 'nullable|image|max:5000',
            'description' => 'required|string',
            'banner' => 'nullable|image|max:10000',
            'category_ids' => 'exists:categories,id|nullable',
        ]);

        $data = $request->all();

        $data['slug'] = $this->generateSlug($data['name'], $restaurant->name != $data['name'], $restaurant->slug);

        if (array_key_exists('logo', $data)) {
            $logo = Storage::put('uploads', $data['logo']);
            $data['logo'] = 'storage/' . $logo;
        }

        if (array_key_exists('banner', $data)) {
            $banner = Storage::put('uploads', $data['banner']);
            $data['banner'] = 'storage/' . $banner;
        }

        $restaurant->update($data);

        if (array_key_exists('category_ids', $data)) {
            $restaurant->categories()->sync($data['category_ids']);
        } else {
            $restaurant->categories()->detach();
        }

        return redirect()->route('admin.restaurants.show', ['restaurant' => $restaurant->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->categories()->detach();
        $restaurant->delete();
        return redirect()->route('admin.restaurants.index');
    }


    private function generateSlug(string $title, bool $change = true, string $old_slug = '')
    {

        if (!$change) {
            return $old_slug;
        }

        $slug = Str::slug($title, '-');
        $slug_base = $slug;
        $contatore = 1;

        $post_with_slug = Restaurant::where('slug', '=', $slug)->first();
        while ($post_with_slug) {
            $slug = $slug_base . '-' . $contatore;
            $contatore++;

            $post_with_slug = Restaurant::where('slug', '=', $slug)->first();
        }
        return $slug;
    }
}