<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Place;

class TripController extends Controller
{
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
    public function save(Request $request)
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

        return view('trips/remove', ['place' => $place]);
    }

    public function destroy(Request $request, $slug)
    {
        $place = $request->user()->places()->where('slug', $slug)->first();

        $place->pivot->delete();

        return redirect('/mytrip')->with([
            'flash-alert' => $place->place . ' was removed from My Trip.',
        ]);
    }
}