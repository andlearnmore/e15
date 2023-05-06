<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Validation\Rule;
use Illuminate\View\View;

use App\Models\City;
use App\Models\Country;
use App\Models\Place;


class PlaceController extends Controller
{
    public $hours = [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
    public $minutes = ['00', '30'];

    public function index(Request $request, $country, $city)
    {
        $country = Country::where('code', '=', $country)->first();
        $city = City::where('slug', '=', $city)->first();
        // TODO: Fix what happens if city doesn't exist
        // if (!$city) {
        //     return redirect('/countries')->with(['flash-alert' => 'Country not found.']);
        // }
        $places = Place::where('city_id', '=', $city->id)->get();

        return view('/places/index', [
            // TODO: Figure out how to get country in here.
            'country' => $country, 
            'city' => $city, 
            'places' => $places,
        ]);
    }

    public function show(Request $request, $country, $city, $place)
    {
        $place = Place::where('slug', '=', $place)->first();
        $city = City::where('slug', '=', $city)->first();

        // if (!$place) {
        //     return redirect('/books')->with(['flash-alert' => 'Book not found.']);
        // }

        // # Look at current book, look at users relationship, looking for the user
        // # that matches our currently logged in user and then if the count of books >=1
        // # onList will be true.
        // $onList = $book->users()->where('user_id', $request->user()->id)->count() >= 1;

        return view('places/show', [
            'place' => $place,
            'city' => $city,
            'country' => $country
            // 'onList' => $onList
        ]);
    }

    public function create(): View
    {
        $cities = City::orderBy('slug')->select(['id', 'city'])->get();

        return view('places/create', [
            'cities' => $cities,
            'hours' => $this->hours,
            'minutes' => $this->minutes
        ]);        
    }

    public function store(Request $request)
    {
        // dump($request->all());
        // var_dump($this->hours);
        // dd('the end/');

        $cities = City::orderBy('slug')->select(['id', 'city'])->get();

        # Validate form data
        

        $request->validate([
            'place' => 'required|max:100',
            // 'city_id' => 'required',
            // 'url' => 'required|url',
            'open_hour' => [
                // 'integer',
                Rule::in($this->hours)],
            // 'open_minute' => [
            //     Rule::in($this->minutes)],
// TODO: Get greate than validation to work.
            // 'closed_hour' => [
            //     'gt:open_hour',
            //     Rule::in($this->hours)
            // ],
            // 'closed_minutes' => [Rule::in($this->minutes)],
        ]);

        var_dump($request->open_hour);
        $place = new Place();
        $place->place = $request->place;
        $place->slug = Str::slug($place->place, '-');
        $place->open = $request->open_hour . ':' . $request->open_minute;
        $place->closed = $request->closed_hour . ':' . $request->closed_minute;

        $place->city_id = $request->city_id;
        dd($place);


        // TODO: Process the form data

        // TODO: make times from form data
    //     // $place_name = 'Whatever the user enters.';
    //     // dd(slug);

    }


}