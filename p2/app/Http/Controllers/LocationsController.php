<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LocationsController extends Controller
{
    public function index() {
        # This page will contain the form.
        # Load location data using PHP's file_get_contents
        # We specify the locations.json file path using Laravel's database_path helper
        $locationData = file_get_contents(database_path('locations.json'));

        # Convert the string of JSON text loaded from locations.json into an 
        # array using PHP's built-in json_decode function
        $locations = json_decode($locationData, true);

        # Alphabetize the locations by slug using Laravel's Arr::sort
        $locations = Arr::sort($locations, function($value) {
            return $value['loc_name'];
        });
    
        # I'm choosing to use only whole-hour open times and location lengths for now, as integers.
        # If I have time, I'll explore how to use time instead of integers.




        // dd($locations['18']);

        return view('planner/index', ['locations' => $locations]);
    }

    public function show() {
        # This page will show the completed itinerary.
        return view('planner/show');
    }
}