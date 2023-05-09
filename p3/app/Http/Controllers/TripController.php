<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


use App\Models\City;
use App\Models\Place;


class TripController extends Controller
{
    # There must be a better way to show this, because it's repeated here and in PlaceController.
    # Make it a class?
    public $hours = [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
    public $minutes = ['00', '30'];

    public function show(Request $request)
    {
        $places = $request->user()->places->sortByDesc('pivot.created_at');
        $city_ids = [];        

        foreach ($places as $place) {
            $city_ids[] = $place->city_id;
        }
        $unique_city_ids= array_unique($city_ids);
        
        $cities = City::whereIn('id', $unique_city_ids)->get();
        
        
        return view('trips/show', [
            'cities' => $cities,
            'places' => $places
        ]);
    }

    /**
     * POST /mytrip/{{ $place->slug }}/save
     */
    public function add(Request $request)
    {
        $slug = $request->slug;
        $newPlace = Place::findBySlug($slug);

        // TODO: Make sure place isn't already in table.
        $request->user()->places()->save($newPlace);

        return redirect('/mytrip')->with([
            'flash-alert' => $newPlace->place . ' was added to My Trip.',
        ]);
    }

    /**
     * GET /mytrip/{slug}/remove
     */
    public function delete(Request $request)
    {
        $slug = $request->slug;

        $place = Place::findBySlug($slug);
        if (!$place) {
            return redirect('/mytrip')->with([
                'flash-alert' => 'This place is not on your My Trip list..'
            ]);
        }

        return view('trips/remove', [
            'place' => $place,
        ]);
    }

    public function destroy(Request $request, $slug)
    {
        $place = $request->user()->places()->where('slug', $slug)->first();

        $place->pivot->delete();

        return redirect('/mytrip')->with([
            'flash-alert' => $place->place . ' was removed from My Trip.',
        ]);
    }

    public function edit(Request $request, $slug)
    {
        $place = Place::where('slug', '=', $slug)->first();
        
        if ($place->user_id == null || $place->user_id != $request->user()->id){
            return redirect('/mytrip')->with([
                'flash-alert' => 'You cannot edit this place.'
            ]);
        } else {
            $cities = City::orderBy('slug')->select(['id', 'city'])->get();

            return view('trips/edit', [
                'place' => $place, 
                'cities' => $cities,
                'hours' => $this->hours,
                'minutes' => $this->minutes
    
            ]);
        }

    }

    public function update(Request $request, $slug)
    {
        $place = Place::findBySlug($slug);
        # Validate form data
        $request->validate([
            'place' => 'required|max:100',
            'city_id' => 'required',
            'url' => 'url|required',
            'open_hour' => [Rule::in($this->hours)],
            'open_minute' => [Rule::in($this->minutes)],
            'closed_hour' => [Rule::in($this->hours)],
            'closed_minutes' => [Rule::in($this->minutes)],
        ]);

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

        
        return ('UPDATE VIEW!');
    }
}