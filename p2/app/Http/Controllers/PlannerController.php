<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\Mime\Header\UnstructuredHeader;

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
        $tripLength = (int)$request->input('tripLength');
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
        $plans = []; # Array to keep track of the plans to print to /show view
        $itineraryLocations = []; # Array to keep track of data for each place submitted in $formPlaces
        $unscheduledLocations = []; # Array to keep track of locations that still need scheduling

        # Add data for locations being visited into an array called $itineraryLocations.
        foreach ($locations as $location) {
            if (in_array($location['slug'], $formPlaces)) {
                array_push($itineraryLocations, $location);
            };
        }
        # Sort $itineraryLocations array by close time and then open time to optimize array order.
        # This way, the locations that open the earliest will be at the beginning of the array,
        # and of those that open at the same time, the ones that close first will be first.
        array_multisort($itineraryLocations, SORT_ASC, SORT_NUMERIC, array_column($itineraryLocations, 'close_time'));
        array_multisort($itineraryLocations, SORT_ASC, SORT_NUMERIC, array_column($itineraryLocations, 'open_time'));
        // dump('INITIAL itineraryLocations:');
        // dump($itineraryLocations);
        
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
        // dump('Day start is ' .$dayStart);


        # Determine initial arrive time.
        // $arrive = ($dayStart > ($itineraryLocations[0]['open_time'])) ? $dayStart : ($itineraryLocations[0]['open_time']);

        ##### LOOP THROUGH $ITINERARYLOCATIONS AND SCHEDULE OR DON'T.
        for ($day = 1; $day <= $tripLength; $day ++) {
            $nextDay = [
                'arrive' => 'Day ' .$day,
                'depart' => '',
                'loc_name' => '',
                'address' => '',
                'loc_metro' => '',
                'loc_open' => '',
                'loc_closed' => ''
            ];
            array_push($plans, $nextDay);
            $numberLocations = count($itineraryLocations);
            $arrive = ($dayStart > ($itineraryLocations[0]['open_time'])) ? $dayStart : ($itineraryLocations[0]['open_time']);
    
            for ($i = 0; $i < $numberLocations; $i++) {
                $depart = $arrive + $itineraryLocations[$i]['loc_visit_length'];

                if ($arrive < $itineraryLocations[$i]['open_time']) { # Location isn't open yet. Insert a break time into schedule.
                    $break = [
                        'arrive' => $arrive,
                        'depart' => $itineraryLocations[$i]['open_time'],
                        'loc_name' => 'Break until the next location opens.',
                        'address' => '',
                        'loc_metro' => '',
                        'loc_open' => '',
                        'loc_closed' => ''
                    ];
                    array_push($plans, $break);
                    $arrive = $depart;
                    $i = $i-1; # This lets us retry with the current location after the break.
                } else { # We are trying to arrive after the location is open.
                    $depart = $arrive + $itineraryLocations[$i]['loc_visit_length'];
                    if ($depart <= $itineraryLocations[$i]['close_time']) { # We have enough time to visit before the place closes.
                        $itineraryLocations[$i]['arrive'] = $arrive;
                        $itineraryLocations[$i]['depart'] = $depart;
                        array_push($plans, $itineraryLocations[$i]);
                        unset($itineraryLocations[$i]);
                        $arrive = $depart;
                    } else { # We can't go because we'd leave after it closed
                        array_push($unscheduledLocations, $itineraryLocations[$i]);
                        // dump('Unscheduled:');
                        // dump($unscheduledLocations);
                        unset($itineraryLocations[$i]);

                    }
                }
            }             
            if ($day < $tripLength) {
                $itineraryLocations = array_splice($unscheduledLocations, 0);
                // dump('unscheduled to itinerary:');
                // dump($itineraryLocations);    
            } 
        }

        // dump('Plans:');
        // dd($plans);
        return redirect('planner/show')->with([
            'dayStart' => $dayStart,
            'itineraryName' => $itineraryName,
            'itineraryLocations' => $itineraryLocations,
            'plans' => $plans,
            'tripLength' => $tripLength,
            'unscheduledLocations' => $unscheduledLocations
        ]);
    }
    
    public function show(){
        return view('planner/show', [
            'dayStart' => session('dayStart', null),
            'itineraryName' => session('itineraryName', null),
            'itineraryLocations' => session('itineraryLocations', null),
            'plans' => session('plans', null),            
            'tripLength' => session('tripLength', null),
            'unscheduledLocations' => session('unscheduledLocations', null)

        ]);
    }

}