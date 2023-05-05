<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\City;
use App\Models\Place;
use Faker\Factory;

class PlacesTableSeeder extends Seeder
{

    private $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Factory::create();
        // TODO: Could I put this in a separate controller and update all seeders?
        $this->addPlacesFromplacesDotJsonFile(); 
    }

    private function addPlacesFromplacesDotJsonFile()
    {
        $placeData = file_get_contents(database_path('places.json'));
        $places = json_decode($placeData, true);

        foreach($places as $slug =>$placeData) {
            $place = new Place();

            # Find each city in the countries table
            $city_id = City::where('city', '=', $placeData['city'])->pluck('id')->first();

            $place->created_at = $this->faker->dateTimeThisMonth();
            $place->updated_at = $place->created_at;
            $place->slug = $placeData['slug'];
            $place->place = $placeData['place'];
            $place->city = $placeData['city'];
            $place->open = $placeData['open'];
            $place->open_time = $placeData['open_time'];
            $place->closed = $placeData['closed'];
            $place->close_time = $placeData['close_time'];
            $place->metro = $placeData['metro'];
            $place->region = $placeData['region'];
            $place->address = $placeData['address'];
            $place->visit_length = $placeData['visit_length'];
            $place->reservation_reqd = $placeData['reservation_reqd'];
            $place->fee = $placeData['fee'];
            $place->url = $placeData['url'];
            $place->description = $placeData['description'];
            $place->city_id = $city_id;
            $place->save();
        }
    }
}