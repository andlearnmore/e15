<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Country;
use App\Models\Place;


class PlaceController extends Controller
{
    public function index(Request $request, $country, $city)
    {
        $country = Country::where('code', '=', $country)->first();
        $city = City::where('slug', '=', $city)->first();
        // TODO: Fix what happens if city doesn't exist
        // if (!$city) {
        //     return redirect('/countries')->with(['flash-alert' => 'Country not found.']);
        // }
        $places = Place::where('city_id', '=', $city->id)->get();

        return view('/places/index', [
            // TODO: Figure out how to get country in here.
            'country' => $country, 
            'city' => $city, 
            'places' => $places,
        ]);
    }

    public function show(Request $request, $country, $city, $place)
    {
        $place = Place::where('slug', '=', $place)->first();
        // dd($city);

        // if (!$place) {
        //     return redirect('/books')->with(['flash-alert' => 'Book not found.']);
        // }

        // # Look at current book, look at users relationship, looking for the user
        // # that matches our currently logged in user and then if the count of books >=1
        // # onList will be true.
        // $onList = $book->users()->where('user_id', $request->user()->id)->count() >= 1;

        return view('places/show', [
            'place' => $place,
            'city' => $city,
            'country' => $country
            // 'onList' => $onList
        ]);
    }


}