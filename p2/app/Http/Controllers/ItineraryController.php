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

        # Alphabetize the locations by slug using Laravel's Arr::sort
        $locations = Arr::sort($locations, function($value) {
            return $value['slug'];
        });
    
        # I'm choosing to use only whole-hour open times and location lengths for now, as integers.
        # If I have time, I'll explore how to use time instead of integers.
        // dump($locations);
        $closed = strtotime($locations[18]['loc_closed']);

        // dump($closed);
        // dump(gettype($closed));

        // $closed2 = date_create($locations[18]['loc_closed']);
        // dump($closed2);
        // dump(gettype($closed2));
        
        $open = strtotime($locations[18]['loc_open']);
        // dump($open);

        // $open2 = date_create($locations[18]['loc_open']);
        // dump($open2);

        // $difference = date_diff($closed2, $open2);
        // dump($difference);
        // dump(gettype($difference));
# intval('42') --> 42;

        $endTime = intval($locations[18]['loc_closed']);
        dump($endTime);


        $duration = $closed-$open;
        dump('Duration = ' .$duration);
        dump('Duration type = ' .gettype($duration));
        $start = '9:00';
        $begin = strtotime($start);
        dump('Begin = ' .$begin);
        dump('Begin type = ' .gettype($begin));
        $newTime = $begin + ($locations[18]['loc_visit_length']);
        dump('NewTime = ' .$newTime);
        dump('NewTime type = ' .gettype($newTime));
        dump(date_parse($locations[18]['loc_closed']));
        # array:12 [▼ // app/Http/Controllers/ItineraryController.php:55
            # "year" => false
            # "month" => false
            # "day" => false
            # "hour" => 14
            # "minute" => 30
            # "second" => 0
            # "fraction" => 0.0
            # "warning_count" => 0
            # "warnings" => []
            # "error_count" => 0
            # "errors" => []
            # "is_localtime" => false
        # ]



        dd($locations['18']);

        return view('itinerary/index', ['locations' => $locations]);
    }

    public function show() {
        # This page will show the completed itinerary.
        return view('itinerary/show');
    }
}