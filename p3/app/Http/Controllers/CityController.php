<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;

class CityController extends Controller
{
    /**
     * GET /
     * Display all cities
     */
    public function index($code)
    {
        // $country = Country::where('code', '=', $code)->first();
        // // if (!$country) {
        // //     return redirect('/countries')->with(['flash-alert' => 'Country not found.']);
        // // }
        // $cities = City::where('country_id', '=', $country->id)->get();

        // // dd($cities);
        // return view('/cities/show', [
        //     'country' => $country
        // ]);
    }

    public function show(Request $request, $code)
    {
        $country = Country::where('code', '=', $code)->first();
        // if (!$country) {
        //     return redirect('/countries')->with(['flash-alert' => 'Country not found.']);
        // }
        $cities = City::where('country_id', '=', $country->id)->get();
        // dd($cities);

        return view('/cities/show', [
            'country' => $country, 
            'cities' => $cities
        ]);
    }


    public function create()
    {
        return view('/{country}/cities/create');
    }
}