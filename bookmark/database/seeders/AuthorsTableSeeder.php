<?php

namespace Database\Seeders;

use App\Models\Author; # ← NEW
use Faker\Factory; # ← NEW
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # https://fakerphp.github.io
        $this->faker = Factory::create();

        # Array of author data to add
        $authors = [
            ['F. Scott', 'Fitzgerald', 1896, 'https://en.wikipedia.org/wiki/F._Scott_Fitzgerald'],
            ['Sylvia', 'Plath', 1932, 'https://en.wikipedia.org/wiki/Sylvia_Plath'],
            ['Maya', 'Angelou', 1928, 'https://en.wikipedia.org/wiki/Maya_Angelou'],
            ['Michelle', 'Obama', 1964, 'https://en.wikipedia.org/wiki/Michelle_Obama'],
            ['Nikole', 'Hannah-Jones', 1976, 'https://en.wikipedia.org/wiki/Nikole_Hannah-Jones'],
            ['Clint', 'Smith', 1988, 'https://en.wikipedia.org/wiki/Clint_Smith_(writer)'],
            ['Anthony', 'Weir', 1972, 'https://en.wikipedia.org/wiki/Andy_Weir'],
        ];

        $count = count($authors);

        # Loop through each author, adding them to the database
        foreach ($authors as $authorData) {
            $author = new Author();
            
            $author->created_at = $this->faker->dateTimeThisMonth();
            $author->updated_at = $this->faker->dateTimeThisMonth();
            $author->first_name = $authorData[0];
            $author->last_name = $authorData[1];
            $author->birth_year = $authorData[2];
            $author->bio_url = $authorData[3];
            
            $author->save();
            
            $count--;
        }
    }
}