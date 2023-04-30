<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * GET /
     * Display all cities
     */
    public function index()
    {
        $countries = Country::orderBy('country', 'ASC')->get();
        return view('countries/index', [
            'countries' => $countries
        ]);
    }

    public function create()
    {
        return view('countries/create');
    }

        public function show(Request $request, $code)
        {
            $country = Country::where('code', '=', $code)->first();
            if (!$country) {
                return redirect('/countries')->with(['flash-alert' => 'Country not found.']);
            }
            return view('countries/show', [
                'country' => $country
            ]);
        }

}