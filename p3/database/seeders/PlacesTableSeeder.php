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
        $this->addPlacesFromPlacesDotJsonFile();
        $this->addRandomlyGeneratedPlacesUsingFaker();

    }

    private function addPlacesFromPlacesDotJsonFile()
    {
        $placeData = file_get_contents(database_path('places.json'));
        $places = json_decode($placeData, true);

        foreach($places as $slug =>$placeData) {
            $place = new Place();

            # Find each city in the countries table
            $city_id = City::where('city', '=', $placeData['city'])->pluck('id')->first();

            $place->created_at = $this->faker->dateTimeThisMonth();
            $place->updated_at = $place->created_at;
            $place->place = $placeData['place'];
            $place->slug = $placeData['slug'];
            $place->city = $placeData['city'];
            $place->open = $placeData['open'];
            $place->closed = $placeData['closed'];
            $place->metro = $placeData['metro'];
            $place->region = $placeData['region'];
            $place->address = $placeData['address'];
            $place->visit_length = $placeData['visit_length'];
            $place->reservation_reqd = $placeData['reservation_reqd'];
            $place->fee = $placeData['fee'];
            $place->url = $placeData['url'];
            $place->description = $placeData['description'];
            $place->user_id = null;
            $place->city_id = $city_id;
            $place->save();
        }
    }

    private function addRandomlyGeneratedPlacesUsingFaker()
    {
        # Get all city_ids except Berlin, which has its own places seeder.
        $cities = City::where('city', '!=', 'Berlin')->get()->toArray();

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
                $place->closed = $evening.':00';
                $place->metro = $this->faker->randomElement($metro_options);
                $place->region = null;
                $place->address = $this->faker->streetAddress;

                $place->visit_length = $this->faker->randomNumber(1, 5);
                $place->reservation_reqd = $this->faker->boolean();
                $place->fee = $this->faker->boolean();
                $place->url = 'https://fakerphp.github.io/';
                $place->description = $this->faker->paragraph();
                $place->user_id = null;
                $place->city_id = $city['id'];
                $place->save();
            }
        }
    }
}