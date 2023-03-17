<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ItineraryController extends Controller
{
    public function index() {
        # This page will contain the form.
        # Load location data using PHP's file_get_contents
        # We specify the locations.json file path using Laravel's database_path helper
        $locationData = file_get_contents(database_path('locations.json'));

        # Convert the string of JSON text loaded from locations.json into an 
        # array using PHP's built-in json_decode function
        $locations = json_decode($locationData, true);

        # Alphabetize the books by title using Laravel's Arr::sort
        $locations = Arr::sort($locations, function($value) {
            return $value['slug'];
        });
    
        dump($locations);
        $closed = strtotime($locations[18]['loc_closed']);
        dump($closed);
        $closed2 = date_create($locations[18]['loc_closed']);
        dump($closed2);
        dump(gettype($closed2));
        $open = strtotime($locations[18]['loc_open']);
        // $earlier = (($locations[18]['loc_closed']) - ($locations[18]['loc_open']));

        dump($open);
        dump(gettype($closed));
        $duration = $closed-$open;
        dump($duration);
        dump(gettype($duration));
        dd($locations['18']);
        return view('itinerary/index', ['locations' => $locations]);
    }

    public function show() {
        # This page will show the completed itinerary.
        return view('itinerary/show');
    }
}