<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function welcome() {

        // dd(Str::plural('mouse')); # 'mice'
        // dd(public_path('css/books/show.css')); # '/var/www/e15/bookmark/public/css/books/show.css'
        // dd(public_path()); # '/var/www/e15/bookmark/public'
        // dd(config('app.timezone')); # 'UTC'
        // dd(storage_path('temp')); # '/var/www/e15/bookmark/storage/temp'
        return view('pages/welcome');
    }

    public function contact() {
        return view('pages/contact');
    }
}