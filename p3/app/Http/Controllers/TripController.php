<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Place;

class TripController extends Controller
{
    public function show(Request $request)
    {
        $places = $request->user()->places->sortBy('place');
        $city_ids = [];
        $all_cities = [];
        
        foreach ($places as $place) {
            $city_ids[] = $place->city_id;
        }
            
        foreach ($city_ids as $city_id) {
            $all_cities[] = City::where('id', '=', $city_id)->first();
        }
        $cities=array_unique($all_cities);
        // $cities =sort($cities);
        
        return view('trips/show', [
            'cities' => $cities,
            'places' => $places
        ]);
    }

    /**
     * GET /list/{slug}/add
     */
    public function add($slug){

        $place = Place::findBySlug($slug);

        return view('trips/add', ['place' => $place]);
    }

    /**
     * POST /mytrip/{{ $place->slug }}/save
     */
    public function save(Request $request, $slug)
    {
        $place = Place::findBySlug($slug);

        $request->user()->places()->save($place);

        return redirect('/mytrip')->with([
            'flash-alert' => $place->place . ' was added to My Trip.'
        ]);
    }
}