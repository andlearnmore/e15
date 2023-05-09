<?php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\Tag;
use Faker\Factory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceTagTableSeeder extends Seeder
{
    private $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sites = Place::select('id', 'tag')->get()->toArray();
        foreach ($sites as $site) {
            $tag = Tag::where('tag', '=', $site['tag'])->first();
            $site->tags()->save($tag);
        }

    }
}