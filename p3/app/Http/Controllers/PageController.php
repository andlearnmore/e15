<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * GET /
     * Display application welcome page 
     */
    public function welcome()
    {
        return view('pages/welcome');
    }

        /**
     * GET /
     * Display contact page 
     */

     public function contact()
     {
        return view('pages/contact');
     }

}