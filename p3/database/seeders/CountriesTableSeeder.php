<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Country;
use Faker\Factory;

class CountriesTableSeeder extends Seeder
{

    private $faker;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # https://fakerphp.github.io
        $this->faker = Factory::create();
        $this->addAllFromCountriesDotJsonFile();
    }

    private function addAllFromCountriesDotJsonFile()
    {
        $countryData = file_get_contents(database_path('countries.json'));

        # Decode and alphabetize the countries by name using Laravel's Arr::sort
        $countries = Arr::sort((json_decode($countryData, true)), function ($value) {
            return $value['name'];
        });
        
        foreach($countries as $countryData) {
            $country = new Country();

            $country->created_at = $this->faker->dateTimeThisMonth();
            $country->updated_at = $country->created_at;
            $country->code = $countryData['code'];
            $country->name = $countryData['name'];

            $country->save();
        }
    }
}