<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Place;
use App\Models\User;

class PlaceUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Add 4 places to user jill@harvard.edu's wishlist
        # 3 from Berlin and 1 from Munich
        $user = User::where('email', '=', 'jill@harvard.edu')->first();

        $places = [
            'Sherwood Forest Playground',
            'MachMIT! Museum for Children',
            'Kindermuseum unterm Dach',
            'Deutsches Museum'
        ];

        foreach ($places as $place) {
            $place = Place::where('place', '=', $place)->first();
            $user->places()->save($place);
        }
    }
}