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
        if (!$city) {
            return redirect('/cities')->with(['flash-alert' => 'City not found.']);
        }

        $country = Country::where('code', '=', $request->country)->first();
        if (!$country) {
            return redirect('/cities')->with(['flash-alert' => 'Country not found.']);
        }

        $places = Place::where('city_id', '=', $city->id)->where('user_id', '=', null)->orWhere('user_id', '=', Auth::user()->id)->orderBy('place')->get();

        return view('/cities/show', [
            'city' => $city,
            'country' => $country,
            'places' => $places
            // 'onList' => $onList
        ]);
    }
}