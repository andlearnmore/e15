<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;


class PlaceController extends Controller
{
    public function index(Request $request, $slug)
    {
        $country = Country::where('code', '=', $code)->first();
        $city = City::where('slug', '=', $slug)->first();
        // TODO: Fix what happens if city doesn't exist
        // if (!$city) {
        //     return redirect('/countries')->with(['flash-alert' => 'Country not found.']);
        // }
        $places = Place::where('city_id', '=', $city->id)->get();

        return view('/places/index', [
            // TODO: Figure out how to get country in here.
            'country' => $country, 
            'city' => $city, 
            'places' => $places
        ]);
    }

}