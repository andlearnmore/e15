<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class BookUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Goal: Add three books to user jill@harvard.edu's "list"
        $user = User::where('email', '=', 'jill@harvard.edu')->first();
    
        $books = [
            'Becoming',
            'The Great Gatsby',
            'The Bell Jar'
        ];
    
        foreach ($books as $title) {
            $book = Book::where('title', '=', $title)->first();
            # start with one of your objects->target its relationship method save() 
            # then include other object you want to connect to it
            # Here, second option of array of data (here, notes).
            $user->books()->save($book, ['notes' => 'I really enjoyed reading ' . $title]);
        }
    }
}