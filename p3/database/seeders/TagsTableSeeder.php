<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use App\Models\Tag;
use Faker\Factory;

class TagsTableSeeder extends Seeder
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
        $this->addFiveTags();
    }

    public function addFiveTags()
    {
        $tags = ['art', 'history', 'kids', 'outdoors', 'science'];

        foreach($tags as $seed){
            $tag = new Tag();
            $tag->created_at = $this->faker->dateTimeThisMonth();
            $tag->updated_at = $tag->created_at;
            $tag->tag = $seed;
            $tag->save();
        }
    }
}