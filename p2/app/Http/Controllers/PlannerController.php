<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PlannerController extends Controller
{

    // GET /planner
    // Display the form

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


    // GET /create
    // Create the itinerary and redirect to /show.

    public function create(Request $request) {
        # This page will show the completed itinerary.
        $locationData = file_get_contents(database_path('locations.json'));
        $locations = json_decode($locationData, true);

        # Set the number of hours of activity to 8.
        $hours = 8;

        # Set up tracker for whether lunch has been added to plan.
        $lunchTime = false;
        $lunchComplete = false;

        # Set up whereAmI to keep track of current metro
        $whereAmI = null;

        # Collect form info
        $tripLength = $request->input('tripLength');

        # If Night Owl, start itinerary at 12; otherwise, start at 9.
        if ($request->input('timeSelection' == 'late')) {
            $dayStart = 12;
        } else {
            $dayStart = 9;
        }

        $itineraryName = $request->input('itineraryName');
        $formPlaces = $request->input('formPlaces');
        $itineraryLocations = [];

        # Add data for locations being visited into an array.
        foreach ($locations as $location) {
            if (in_array($location['slug'], $formPlaces)) {
                array_push($itineraryLocations, $location);
            };
        }

        # Determine the number of hours of visit time anticipated.
        $timeNeeded = 0;
        foreach ($itineraryLocations as $itineraryLocation) {
            $timeNeeded += $itineraryLocation['loc_visit_length'];
        }

        # If time needed > time in trip ($hours*$tripLength), return to form (with input intact) and ask them to select fewer activities.
        if ($timeNeeded > ($hours * $tripLength)) {
            return ("You need more time");
            // TODO: Insert actual redirect here.
        }

        // TODO (IDEAL): Process here to get locations that are close together in sequence next to each other.
        // TODO (MVP): Process here to create $plans with $startTime and $endTime for each location
        // START: find lowest open_time among $formPlaces array
        // foreach ($formPlaces as $formPlace);
        // dd($earliest);

        // max_with_key($array, $key)

        # https://stackoverflow.com/questions/4497810/min-and-max-in-multidimensional-array
        # Set the first location in $itineraryLocations as the earliest open time ($min).
            if (!is_array($itineraryLocations) || count($itineraryLocations) == 0){
                return false;
            } else {
                $min = $itineraryLocations[0]['open_time'];
            }
        # Loop through $itineraryLocations; if there's an earlier time, reset $min to that time.
            foreach ($itineraryLocations as $itineraryLocation) {
                if ($itineraryLocation['open_time'] < $min) {
                    $min = $itineraryLocation['open_time'];
                }
            }
            
        # Find first location in $itineraryLocations that has 'open_time' = $min
            
        # $startTime = dayStart or $loc_open, whichever is later.
            //  
        // Step 0: $endTime = $startTime + loc_visit_length
        // $whereAmI = loc_metro
        // Add $startTime to array and array to $plans
        // $startTime = $endTime;
        // if $startTime >= 12, lunchTime = true;
        // TODO: (0.5) If $lunchTime = true && $lunchComplete = false, add hour for lunch to $plan and set $lunchComplete = true 
        // TODO: (1) Is there another location? No: DONE. Yes: (1.5) With same loc_metro? No: go to next in array. Yes: go to that one
        // TODO: (2) Is the location open? Is the loc_open < $startTime? No: go back to step 1. Yes: go to step 3.
        // TODO: (3) Is there enough time to visit it? Is $startTime < $closeTime? No: go back to step 1. Yes: go to step 0.

        dump($request->input());
        dump($dayStart);
        dump('Time needed is ' .$timeNeeded .' hours.');
        dd($itineraryLocations);
        return redirect('planner/show')->with([
            'tripLength' => $tripLength,
            'dayStart' => $dayStart,
            'itineraryName' => $itineraryName,
            'itineraryLocations' => $itineraryLocations
            // 'plans' => $plans
        ]);
    }
    
    public function show(){
        return view('planner/show', [
            'tripLength' => session('tripLength', null),
            'dayStart' => session('dayStart', null),
            'itineraryName' => session('itineraryName', null),
            'itineraryLocations' => session('itineraryLocations', null)
        ]);
    }

}