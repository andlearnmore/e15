<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class TripController extends Controller
{
    public function show(Request $request)
    {
        $places = $request->user()->places->sortByDesc('pivot.created_at');
        $city_ids = [];
        $all_cities = [];
        
        foreach ($places as $place) {
            $city_ids = $place->city_id;
        }
            
        foreach ($city_ids as $city_id) {
            $all_cities = City::where('id', '=', $city_id)->first();
        }
        $cities=array_unique($all_cities);
        
        return view('trips/show', [
            'cities' => $cities,
            'places' => $places
        ]);
    }
}