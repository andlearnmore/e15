<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Seeder;

use Faker\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


use App\Models\City;
use App\Models\Country;
use App\Models\Place;
use App\Models\Tag;




class PracticeController extends Controller
{

    public function practice8() 
    {
        $places = Place::select('id', 'tag')->get()->toArray();
        // dd($places);
        foreach ($places as $place) {
            $tag = Tag::where('tag', '=', $place['tag'])->first();
            dump($tag);
        }
    }
    public function practice7() {
        $placeData = file_get_contents(database_path('places.json'));
        $places = json_decode($placeData, true);

        foreach($places as $placeData) {
            $place = new Place();
            $place->tag = $placeData['tag'];
        }

        dd($place);
    }
    public function practice6() {

        $this->faker = Factory::create();


    $tags = ['art', 'history', 'kids', 'outdoors', 'science'];

    for ($i = count($tags) - 1; $i > 0; $i--){
        $tag = new Tag();
        $tag->created_at = $this->faker->dateTimeThisMonth();
        $tag->updated_at = $tag->created_at;
        $tag->tag = $tags[$i];
        dump($tag);
    }
}

    


    /**
     * Practice for places seeder
     */
    public function practice5()
    {
        $this->faker = Factory::create();

        # Get all city_ids except Berlin, which has its own places seeder.
        $cities = City::where('city', '!=', 'Berlin')->get()->toArray();
        $city_ids = City::where('city', '!=', 'Berlin')->get('id')->toArray();
        
        foreach ($cities as $city) {
            for ($i = 0; $i < 4; $i++) {
                $place = new Place();

                $place_name = $this->faker->words(rand(2, 4), true);
                $morning = $this->faker->numberBetween(8, 12);
                $evening = $this->faker->numberBetween(14, 23);
                for ($j = 0; $j < 4; $j++) {
                    $metro_options[]= Str::title($this->faker->streetName(rand(1, 3), true));
                }

                $place->created_at = $this->faker->dateTimeThisMonth();
                $place->updated_at = $place->created_at;
                $place->place = Str::title($place_name);
                $place->slug = Str::slug($place_name, '-');
                $place->city = $city['city'];
                $place->open = $morning.':00';
                $place->open_time = $morning;
                $place->closed = $evening.':00';
                $place->close_time = $evening;
                $place->metro = $this->faker->randomElement($metro_options);
                $place->region = null;
                $place->address = $this->faker->streetAddress;

                $place->visit_length = $this->faker->randomNumber(1, 5);
                $place->reservation_reqd = $this->faker->boolean();
                $place->fee = $this->faker->boolean();
                $place->url = 'https://hesweb.dev/e15';
                $place->description = $this->faker->paragraph();
                $place->city_id = $city['id'];
                dump($place);
            }
        }
    }

    public function practice4()
    {
        $placeData = file_get_contents(database_path('places.json'));
        // dump($placeData);
        $places = json_decode($placeData, true);
        dump($places);
        $city_id = City::where('city', '=', $placeData['city'])->pluck('id')->first();
        dd($city_id);

    }

    public function practice3()
    {
        $cityData = file_get_contents(database_path('cities.json'));
        dump($cityData);
        $cities = json_decode($cityData, true);
        dump($cities);
        foreach ($cities as $slug => $cityData) {
            $city = new City();

            # Find each country in the countries table
            $country_id = Country::where('code', '=', $cityData['country'])->pluck('id')->first();

            dump($country_id);
        }
    }

    public function practice2()
    {
        $countryData = file_get_contents(database_path('countries.json'));
        dump($countryData);
        $countries = json_decode($countryData, true);
        dd($countries);


        # Decode and alphabetize the countries by name using Laravel's Arr::sort
        $countries = Arr::sort((json_decode($countryData, true)), function ($value) {
            return $value['name'];
        });
        dd($countries);
        
        foreach($countries as $countryData) {
            $country = new Country();
            dd('hello');
            $country->created_at = $this->faker->dateTimeThisMonth();
            $country->updated_at = $country->created_at;
            $country->code = $countryData['code'];
            $country->name = $countryData['name'];
            dd($country);

            $country->save();
            dump($country);
        }
    }

    /**
     * First practice example
     * GET /practice/1
     */
    public function practice1()
    {

        // For: CITIES SEEDER
        // TODO: Figure out how to get countries used dynamically. (MVP+)
        $cityData = file_get_contents(database_path('cities.json'));
        $cities = json_decode($cityData, true);
        dump($cityData);

        foreach ($cities as $cityData) {
            $city = new City();
            // dump($cityData['slug']);
            // dump($cityData['city']);
            // dump($cityData['country']);
            // dump($cityData['slug']);



            # Find each country in the countries table
            $country_id = Country::where('code', '=', $cityData['country'])->pluck('id')->first();
            // dump($country_id);
            $city->slug = $cityData['slug'];
            $city->name = $cityData['city'];
            $city->country = $cityData['country'];
            $city->country_id = $country_id;
            // $city->save();
            dump($city);
        }
    }

    /**
     * ANY (GET/POST/PUT/DELETE)
     * /practice/{n?}
     * This method accepts all requests to /practice/ and
     * invokes the appropriate method.
     * http://bookmark.yourdomain.com.loc/practice => Shows a listing of all practice routes
     * http://bookmark.yourdomain.com.loc/practice/1 => Invokes practice1
     * http://bookmark.yourdomain.com.loc/practice/5 => Invokes practice5
     * http://bookmark.yourdomain.com.loc/practice/999 => 404 not found
     */
    public function index(Request $request, $n = null)
    {
        $methods = [];

        # Load the requested `practiceN` method
        if (!is_null($n)) {
            $method = 'practice' . $n; # practice1

            # Invoke the requested method if it exists; if not, throw a 404 error
            return (method_exists($this, $method)) ? $this->$method($request) : abort(404);
        } # If no `n` is specified, show index of all available methods
        else {
            # Build an array of all methods in this class that start with `practice`
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }

            # Load the view and pass it the array of methods
            return view('practice')->with(['methods' => $methods]);
        }
    }
}