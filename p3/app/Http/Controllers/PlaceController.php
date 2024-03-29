<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rule;
use Illuminate\View\View;

use App\Models\City;
use App\Models\Country;
use App\Models\Place;



class PlaceController extends Controller
{
    # There must be a better way to show this, because it's repeated here and in TripController.
    # Make it a class?
    public $hours = [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
    public $minutes = ['00', '30'];

    public function show(Request $request, $country, $city, $place)
    {
        $place = Place::where('slug', '=', $place)->first();
        $city = City::where('slug', '=', $city)->first();

        if (!$place) {
            return redirect('/{$country}/{$city}')->with([
                'flash-alert' => 'Place not found.'
            ]);
        }

        $onList = $place->users()->where('user_id', $request->user()->id)->count() >= 1;

        return view('/places/index', [
            'place' => $place,
            'city' => $city,
            'country' => $country,
            'onList' => $onList
        ]);
    }

    public function create()
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

        # Validate form data
        $request->validate([
            'place' => 'required|max:100|unique:places,place',
            'city_id' => 'required',
            'url' => 'url|required',
            'open_hour' => [Rule::in($this->hours)],
            'open_minute' => [Rule::in($this->minutes)],
            'closed_hour' => [Rule::in($this->hours)],
            'closed_minutes' => [Rule::in($this->minutes)],
        ]);        

        # Store form data
        $place = new Place();
        $place->place = $request->place;
        $place->slug = Str::slug($place->place, '-');
        $place->open = $request->open_hour . ':' . $request->open_minute;
        $place->closed = $request->closed_hour . ':' . $request->closed_minute;
        $place->metro = $request->metro;
        $place->address = $request->address;
        $place->visit_length = $request->visit_length;
        $place->reservation_reqd = $request->reservation == 'reservation' ? '1' : '0';
        $place->fee = $request->fee == 'fee' ? '1' : '0';
        $place->url = $request->url;
        $place->description = $request->description;
        $place->city_id = $request->city_id;
        $place->user_id = Auth::user()->id;
        $place->save();

        $request->user()->places()->save($place);
    
        return view('places/new', [
            'place' => $place
        ]);
    
    }


}