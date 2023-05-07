<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Country;
use App\Models\City;
use App\Models\Place;


class CityController extends Controller
{

    public function index()
    {
        $countries = Country::orderBy('country', 'ASC')->get();
        $cities = City::orderBy('city', 'ASC')->get();

        return view('/cities/index', [
            'countries' => $countries, 
            'cities' => $cities
        ]);
    }

    public function show(Request $request) 
    {
        $city = City::where('slug', '=', $request->city)->first();
        $country = Country::where('code', '=', $request->country)->first();
        $places = Place::where('city_id', '=', $city->id)->wherein('added_by', [0, Auth::user()->id])->get();
        // if (!$city) {
        //     return back()->withInput('flash-alert' => 'City not found.');
        // }

        // # Look at current book, look at users relationship, looking for the user
        // # that matches our currently logged in user and then if the count of books >=1
        // # onList will be true.
        // $onList = $book->users()->where('user_id', $request->user()->id)->count() >= 1;

        return view('/cities/show', [
            'city' => $city,
            'country' => $country,
            'places' => $places
            // 'onList' => $onList
        ]);
    }
}