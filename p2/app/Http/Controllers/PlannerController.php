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

        ##### COLLECT FORM DATA AND SET UP VARIABLES

        # Collect form info
        $tripLength = $request->input('tripLength');
        $itineraryName = $request->input('itineraryName');
        $timeSelection = $request->input('timeSelection');
        $formPlaces = $request->input('formPlaces'); # This just gets the slug of each location
            # Validation
            if (!is_array($formPlaces) || count($formPlaces) == 0) {
                return false;
             // TODO: Make "return false" be actually an error reporting.

            };


        # Get data from .json file
        $locationData = file_get_contents(database_path('locations.json'));
        $locations = json_decode($locationData, true);


        # Set up variables and arrays
        $hours = 8; # One day will have $hours hours of activity.
        $lunchTime = false; # Tracker for is it lunch time yet?
        $lunchComplete = false; # Tracker for whether lunch has been eaten
        $currentMetro = null; # Keep track of current metro stop
        $plans = []; # Array to keep track of the plans to print to /show view
        $itineraryLocations = []; # Array to keep track of data for each place submitted in $formPlaces

        # Add data for locations being visited into an array called $itineraryLocations.
        foreach ($locations as $location) {
            if (in_array($location['slug'], $formPlaces)) {
                array_push($itineraryLocations, $location);
            };
        }
        dump($itineraryLocations);
        array_multisort($itineraryLocations, SORT_ASC, SORT_NUMERIC, array_column($itineraryLocations, 'open_time'));

        dd($itineraryLocations);

        ##### CHECK THAT THERE'S ENOUGH TIME TO DO EVERYTHING USER WANTS TO DO.
        # Calculate the number of hours of visit time anticipated.
        $timeNeeded = 0;
        foreach ($itineraryLocations as $itineraryLocation) {
            $timeNeeded += $itineraryLocation['loc_visit_length'];
        }

        # If time needed > time in trip ($hours*$tripLength), return to form (with input intact) and ask them to select fewer activities.
        if ($timeNeeded > ($hours * $tripLength)) {
            return ("You need more time");
            // TODO: Insert actual redirect here.
        }

        # Determine what the start time for the itinerary will be. 
        # If Night Owl, start itinerary at 12; otherwise, start at 9.
        if ($timeSelection == 'late') {
            $dayStart = 12;
        } else {
            $dayStart = 9;
        }
        dump($dayStart);


        // TODO (IDEAL): Process here to get locations that are close together in sequence next to each other.

        ##### SET UP FIRST LOCATION AND TIME.
        # https://stackoverflow.com/questions/4497810/min-and-max-in-multidimensional-array
        # Determine which of the $itineraryLocations has the earliest open time ($min).
        // DON'T NEED ANYMORE BECAUSE I'M SORTING BY OPEN TIME!!!
        // # Start by setting the first location's open time to $min.
        // $min = (int)$itineraryLocations[0]['open_time'];
        // # Loop through $itineraryLocations; if there's an earlier time, reset $min to that time.
        // foreach ($itineraryLocations as $itineraryLocation) {
        //     $min = ((int)$itineraryLocation['open_time'] < $min) ? $itineraryLocation['open_time'] : $min;
        // }
        // dump('Earliest open is ' .$min);
        
        // # Find first location in $itineraryLocations that has 'open_time' = $min
        // $currentLocationKey = array_search($min, array_column($itineraryLocations, 'open_time'));

        # Determine initial arrive time.
        $arrive = ($dayStart > ($itineraryLocations[0]['open_time'])) ? $dayStart : ($itineraryLocations[0]['open_time']);
        dump('Arrive time is ' .$arrive).
        # START LOOPING THROUGH $ITINERARYLOCATIONS, BEGINNING WITH THE ONE WITH CURRENTLOCATIONKEY.

        # Sort $itineraryLocations by open_time.









        # Add $arrive and $depart to currentLocationKey array element

        // $depart = $arrive + (int)$itineraryLocations[$currentLocationKey]['loc_visit_length'];
        // $itineraryLocations[$currentLocationKey]['arrive'] = $arrive;
        // $itineraryLocations[$currentLocationKey]['depart'] = $depart;

        // // $currentMetro = loc_metro

        // # Add $currentLocation to $plans and remove used location from $itineraryLocations so we can 
        // # count down until $itineraryLocations is empty.
        // array_push($plans, $itineraryLocations[$currentLocationKey]);
        // unset($itineraryLocations[$currentLocationKey]);                                                            
        // dump($itineraryLocations);
        // dump($plans);

        // set $arrive = $depart;
        // if $arrive >= 12, lunchTime = true;
        // TODO: (0.5) If $lunchTime = true && $lunchComplete = false, add hour for lunch to $plan and set $lunchComplete = true 
        // TODO: (1) Is there another location? No: DONE. Yes: (1.5) With same loc_metro? No: go to next in array. Yes: go to that one
        // TODO: (2) Is the location open? Is the loc_open < $arrive? No: go back to step 1. Yes: go to step 3.
        // TODO: (3) Is there enough time to visit it? Is $arrive < $closeTime? No: go back to step 1. Yes: go to step 0.

        // dump($request->input());
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