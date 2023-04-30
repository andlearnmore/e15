<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\City;
use App\Models\Country;
use Faker\Factory;

class CitiesTableSeeder extends Seeder
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
        $this->addCitiesFromCitiesDotJsonFile();
    }

    private function addCitiesFromCitiesDotJsonFile()
    {
        $cityData = file_get_contents(database_path('cities.json'));
        $cities = json_decode($cityData, true);

        foreach ($cities as $slug => $cityData) {
            $city = new City();

            # Find each country in the countries table
            $country_id = Country::where('code', '=', $cityData['country'])->pluck('id')->first();

            $city->created_at = $this->faker->dateTimeThisMonth();
            $city->updated_at = $city->created_at;
            $city->slug = $cityData['slug'];
            $city->city = $cityData['city'];
            // $city->country = $cityData['country'];
            $city->country_id = $country_id;
            $city->save();
        }
    }
}